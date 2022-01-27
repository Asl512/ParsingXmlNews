
//Добавление проверки для срока вклада
jQuery.validator.addMethod("maxrules", 
function(value) {
    if($('.wtimeselect').val() == '1')
    {
        return value <= 60;
    }
    else if($('.wtimeselect').val() == '2')
    {
        return value <= 5;
    }
}, 'Не более 5-и лет');

//Добавление проверки для даты открытия
jQuery.validator.addMethod("dateval", 
function(value) {
    var arrD = value.split(".");
    arrD[1] -= 1;
    var date = new Date(arrD[2], arrD[1], arrD[0]);
    return ((date.getFullYear() == arrD[2]) && (date.getMonth() == arrD[1]) && (date.getDate() == arrD[0]));
}, 'Ошибка корректности даты');

//Добавление проверки для суммы пополения
jQuery.validator.addMethod("required_check", 
function(value) {
    if($('.checkbox').is(':checked'))
    {
        return (value != '');
    }
    else
    {
        return false;
    }
}, 'Введите сумму пополнения');


$(document).ready(function()
{  
    //Ввод только цифр (и точки с запятой)
    $('body').on('input', '.numbertext', function(){
        this.value = this.value.replace(/[^0-9.,]/g, '');
    });

    //насилько запретить для процентной ставки от 3 до 100
    /*
    $('body').on('input', '.rangetext', function(){
        if (this.value < 3) 
        {
            this.value = 3;
        } 
        else if (this.value > 100) 
        {
            this.value = 100;
        } 
        else 
        {
            this.value = this.value;
        }
    });*/
    
    //конвертации месяцев в года, года в месяцы
    $('.wtimeselect').change(function(){
        var value_wtimeselect = $('.wtimetext').val();
        if($('.wtimeselect').val() == '1')
        {
            $('.wtimetext').val(value_wtimeselect*12);
        }
        else if($('.wtimeselect').val() == '2')
        {
            $('.wtimetext').val(Math.round(value_wtimeselect/12));
        }
    });

    //Чекбокс ежемесячное пополнение
    $('.checkbox').change(function(){
        if($('.checkbox').is(':checked'))
        {
            $('.replenishment').css('opacity','1');
            $('#replenishment-error').css('opacity','1');
            $('.replenishment').prop("disabled", false);
        }
        else
        {
            $('.replenishment').css('opacity','0');
            $('#replenishment-error').css('opacity','0');
            $('.replenishment').prop("disabled", true);
        }
    });

    //Валидация
    $(".content").validate({
      rules:{
        startDate:{
            required: true,
            dateval: true
        },
        
        term:{
           required: true,
           number: true,
           min: 1,
           maxrules: true
         },

         summa:{
            required: true,
            number: true,
            min: 1000,
            max: 3000000
        },
        percent:{
            required: true,
            number: true,
            min: 3,
            max: 100
        },
        replenishment:{
            required_check: true,
            number: true,
            min: 0,
            max: 3000000
        }
      },
      
      messages:{
        startDate:{
            required:'Введите дату открытия',
        },
        term:{
          required: "Введите срок вклада",
          number: "Здесь должно быть числовое значение",
          min: "Срок выплаты не может быть меньше 1",
        },
        percent:{
            required:'Введите процентную ставку',
            number: "Здесь должно быть числовое значение",
            min: "Минимальная процентная ставка 3%",
            max: "Максимальная процентная ставка 100%",
        },
        summa:{
            required:'Введите сумму вклада',
            number: "Здесь должно быть числовое значение",
            min: "Минимальная сумма выплаты 1 000",
            max: "Максимальная сумма выплаты 3 000 000",
        },
        replenishment:{
            number: "Здесь должно быть числовое значение",
            min: "Минимальная сумма пополнения 0",
            max: "Максимальная сумма пополнения 3 000 000",
        },

      },

      submitHandler: function() {
        ajaxRequst();
      }
   });

});

function ajaxRequst()
{
    $.ajax({
        type: "POST",
        url: 'calc.php',
        data: $('.content').serialize(),
        success: function(response)
        {
            var jsonData = JSON.parse(response);
            result(jsonData.summa);
        }
        });
}

function result(result)
{
    $('.unline').css('display','block');
    $('.summaresult').css('display','block');
    $('.textsumma').css('display','block');
    var strresult = result.toString();
    var summa = strresult.replace(/(\d{1,3}(?=(?:\d\d\d)+(?!\d)))/g, "$1" + " ");
    $('.summaresult').text('₽ '+summa);
}