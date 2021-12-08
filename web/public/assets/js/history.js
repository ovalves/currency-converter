class History {
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
        this.bindUI();
    }

    bindUI() {
        $(function () {
            $("#historyTable").DataTable({
                "ajax": `${API_URL}/orders?user_id=${USER_ID}`,
                "columns": [
                    { "data": "codein" },
                    { "data": "code" },
                    { "data": "bid" },
                    { "data": "description" },
                    { "data": "value" },
                    { "data": "value_converted" },
                    { "data": "total_tax" },
                    { "data": "payment" }
                ],
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            })
            .buttons()
            .container()
            .appendTo('#example1_wrapper .col-md-6:eq(0)');
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
}

new History();
