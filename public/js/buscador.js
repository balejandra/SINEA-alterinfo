$(document).ready(function () {
    ////// BUSQUEDA USUARIO CAPITANIAS //////
    $("#email_user").easyAutocomplete({
        url: function (search) {
            return route('capitaniauser.search') + "?search=" + search;
        },
        theme: "blue-light",cssClasses: "form-group col-md-4 col-sm-12",
        getValue: "email",
        adjustWidth: false,
        list: {
            maxNumberOfElements: 15,
            sort: {
                enabled: true
            },
            onSelectItemEvent: function () {
                if ($("#email_user").getSelectedItemData().apellidos==null){
                    apellidos=""
                }else {
                    apellidos=$("#email_user").getSelectedItemData().apellidos
                }

                let nombres = $("#email_user").getSelectedItemData().nombres+" "+apellidos;
                $("#nombres").val(nombres).trigger("change");
                let id = $("#email_user").getSelectedItemData().id;
                $("#user_id").val(id).trigger("change");
            }
        }
    });

    ////// BUSQUEDA USUARIO CONSULTAS //////
    $("#solicitante").easyAutocomplete({
        url: function (search) {
            return route('user.searchNombres') + "?search=" + search;
        },
        theme: "blue-light",cssClasses: "form-group col-md-4 col-sm-12",
        getValue: function(element) {
            if (element.apellidos==null){
                return element.nombres;
            }else{
                return element.nombres + " " + element.apellidos;
            }

        },
        adjustWidth: false,
        list: {
            maxNumberOfElements: 15,
            sort: {
                enabled: true
            },
            onSelectItemEvent: function () {

                let id = $("#solicitante").getSelectedItemData().id;
                $("#solicitante_id").val(id).trigger("change");
            }
        }
    });
});
