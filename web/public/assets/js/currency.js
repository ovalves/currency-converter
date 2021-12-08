class Currency {
    constructor() {
        this.BOLETO_TYPE = 1;
        this.BOLETO_LABEL = 'Boleto';
        this.CREDIT_CARD_TYPE = 2;
        this.CREDIT_CARD_LABEL = 'Cartão de crédito';
        this.selectedPaymentType = null;
        this.payments = null;
        this.codeout = null;
        this.codeinValue = null;

        this.init();
    }

    init() {
        this.getPaymentTaxes();
        this.getCurrencyCodes();
        this.bindUI();
    }

    bindUI() {
        let that = this;

        $('#credit-card-button').on('click', function () {
            $(this).removeClass('btn-light');
            $('#boleto-button').addClass('btn-light');
            $(this).addClass('btn-success');
            that.checkPaymentMethod(that.CREDIT_CARD_TYPE, that.CREDIT_CARD_LABEL);
        });

        $('#boleto-button').on('click', function () {
            $(this).removeClass('btn-light');
            $('#credit-card-button').addClass('btn-light');
            $(this).addClass('btn-success');
            that.checkPaymentMethod(that.BOLETO_TYPE, that.BOLETO_LABEL);
        });

        $("#next").on('click', function () {
            that.codeinValue = $("#codein-value").val();
            $("#convert-value").html(
                new Intl.NumberFormat('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                }).format(
                    that.codeinValue
                )
            );

            that.codeout = $("#codeout-select option:selected").val();
            $("#codein-codeout").html(`BRL - ${that.codeout}`);
        });

        $("#calculate").on('click', function () {
            that.preload('show');
            that.calculateConversion();
        });
    }

    getCurrencyCodes() {
        $.ajax({
            url: `${API_URL}/currency/codes`,
            success: function (response) {
                let html = '<option selected="selected">Selecionar Moeda</option>';

                for (let [key, value] of Object.entries(response.data)) {
                    html += `<option value="${value.type}">${value.label} - ${value.type}</option>`;
                }

                $("#codeout-select").html(html);
            }
        });
    }

    getPaymentTaxes() {
        let that = this;
        $.ajax({
            type: 'GET',
            url: `${API_URL}/payment/types`,
            success: function (response) {
                that.payments = response.data;
                $('#boleto-button').click();
            }
        });
    }

    checkPaymentMethod(type, label) {
        let that = this;
        that.selectedPaymentType = type;
        let payment = that.payments.filter(({type}) => type == that.selectedPaymentType)[0].tax;
        $(".payment-percent-tax").html(payment);
        $("#payment-type").html(label);
    }

    preload(visibilty) {
        const $preloader = $('.preloader')
        if ($preloader) {
            if (visibilty == 'show') {
                $preloader.css('height', '100vh');
                $preloader.children().show();
                return;
            }

            $preloader.css('height', '0');
            $preloader.children().hide();
        }
    }

    calculateConversion() {
        let that = this;
        $.ajax({
            type: 'POST',
            processData: false,
            url: `${API_URL}/currency/convert`,
            data: JSON.stringify({
                code: that.codeout,
                value: that.codeinValue,
                payment: that.selectedPaymentType,
                email: true
            }),
            contentType: "application/json",
            dataType: 'json',
            success: function (response) {
                that.preload('hide');
                $("#payment-tax").html(
                    new Intl.NumberFormat('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    }).format(
                        response.data.tax.payment
                    )
                );

                $("#convert-tax").html(
                    new Intl.NumberFormat('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    }).format(
                        response.data.tax.convert
                    )
                );

                $("#codein-codeout-value").html(
                    new Intl.NumberFormat('pt-BR', {
                        style: 'currency',
                        currency: response.data.code
                    }).format(
                        response.data.value_converted
                    )
                );

                $("#codeout").html(response.data.code);

                $("#convert-total").html(
                    new Intl.NumberFormat('pt-BR', {
                        style: 'currency',
                        currency: 'BRL'
                    }).format(
                        response.data.value_with_tax
                    )
                );
            },
            error: function (err) {
                that.preload('hide');
                console.log(err);
            }
        });
    }
}

new Currency();
