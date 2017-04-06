$(document).ready(function () {

    var navListItems = $('ul.setup-panel li a'),
            allWells = $('.setup-content');

    allWells.hide();

    navListItems.click(function (e)
    {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this).closest('li');

        if (!$item.hasClass('disabled')) {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target.show();
        }
    });



    $('ul.setup-panel li.active a').trigger('click');

    // DEMO ONLY //
    $('#activate-step-2').on('click', function (e) {
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        $(this).remove();
        $('#label-servico').html($('#sel-servico option:selected').html());
    })

    $('#activate-step-3').on('click', function (e) {
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        $(this).remove();
    })
    
    $('#activate-step-4').on('click', function (e) {
        $('ul.setup-panel li:eq(3)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-4"]').trigger('click');
        $(this).remove();
    })
});

$('#sel-servico').change(function () {
    //console.log($(this).val());

    $('#activate-step-2').prop('disabled', 'disabled');


    if ($(this).val() > 0)
    {
        $('#activate-step-2').removeAttr('disabled');

    }
    carregaBarbeiros($(this).val());
    $('#hid-servico').val($(this).val());
    
    
});

$('#sel-dia').change(function () {
    geraHorarios($(this).val(), $('#hid-barbeiro').val() );
});

$("#profissionais").on("click", "input[name=profSelecionado]", function () {
    $("#activate-step-3").removeAttr('disabled');
    $('#hid-barbeiro').val($(this).val());
});

$("#horarios").on("click", "input[name=horario]", function() {
   $("#activate-step-4").removeAttr('disabled');
   var horario = $('#sel-dia').val();+''+$(this).val();
   $('#hid-horario').val(horario);
});

function carregaBarbeiros(idServico)
{
    $.getJSON("/profissionais?servico=" + idServico, function (retorno) {

        $('#profissionais').empty();

        retorno.forEach(function (el) {
            var radio = '<div class="radio">'
                    + '<label>'
                    + '<input type="radio" name="profSelecionado" value="' + el.id + '" >'
                    + el.nome
                    + '</label>'
                    + '</div>';

            $('#profissionais').append(radio);
        });

    });


}

function geraHorarios(dia)
{
    $.getJSON("/horarios?dia=" + dia+"&barbeiro="+barbeiro, function (retorno) {

        $('#horarios').empty();

        retorno.forEach(function (el) {

            var disponivel = (el.disponivel == true) ? 'Disponivel' : 'Indisponivel';
            var disabled = (el.disponivel == true) ? '' : 'disabled="disabled"';

            var radio = '<div class="radio">'
                    + '<label><input type="radio"  name="horario" value="' + el.hora + '"' + disabled + ' />'
                    + el.hora + ' - ' + disponivel + '</label>'
                    + '</div>';

            $('#horarios').append(radio);
        });


    });
}