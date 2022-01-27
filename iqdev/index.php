<html>
    <head>
        <meta charset="UTF-8">
        <title>Deposit calculator</title>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="https://interview.pages.iqdev.digital/junior-backend-developer/assets/favicon.svg">
        <link rel="stylesheet" href="assets/datepicker/css/datepicker.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script type="text/javascript" src="assets/jquery.validate.min.js"></script>
        <script src="assets/datepicker/js/datepicker.min.js"></script>
        <script src="assets/datepicker/js/i18n/datepicker.en.js"></script>
        <script src="assets/datepicker/js/fscript.js"></script>
        <script src="script.js"></script>
    </head>
    <body>
        <header class = 'row'>
            <img class = 'logo iheader' src = 'https://interview.pages.iqdev.digital/junior-backend-developer/assets/logo-mini.png'>
            <h2 class = 'textw iheader'>iq dev</h2>
            <p class = 'textw iheader t1'>Deposit calculator</p>
        </header>

        <form class = 'content column' action = 'index.php' method="get">
            <p class = 't3'>Депозиторный калькулятор</p>
            <p class = 't1'>Калькулятор депозиторов позволяет рассчитать ваши доходы после внесения суммы на счет в банке по определенному тарифу.</p>

            <div class = 'line row'>
                <div class='column'>
                    <input type="text" autocomplete ='off' name="startDate" class ='input numbertext startDate' placeholder = 'Дата открытия' maxlength="10">
                    <label id="startDate-error" for ='startDate' class ='error'></label>
                </div>

                <div>
                    <div class ='row wtime'>
                        <input type ='text' placeholder = 'Срок вклада'  name ='term' class ='wtimetext numbertext'> 
                        <select class ='wtimeselect t1' name = 'select'>
                            <option value = '1'>месяц</option>
                            <option value = '2'>год</option>
                        </select>
                    </div>
                    <label id="term-error" for ='term' class ='error'></label>
                </div>
            </div>


            <div class = 'line row'>
                <div>
                    <input type ='text' class ='input numbertext' placeholder = 'Сумма вклада' name = 'summa'> 
                    <label id="summa-error" for ='summa' class ='error'></label>
                </div>

                <div>
                    <input type ='text' class ='input numbertext rangetext' placeholder = 'Процентная ставка, % годовых' name = 'percent'> 
                    <label id="percent-error" for ='percent' class ='error'></label>
                </div>
            </div>

            
            <div class = 'line row'>
                <div class='row'>
                    <input type="checkbox" id="mdr" class ='checkbox'>
                    <label for="mdr">Ежемесячное пополнение вклада</label>
                </div>
                
                <div>
                    <input type ='text' class ='input replenishment numbertext' disabled placeholder = 'Сумма пополнение вклада' name = 'replenishment'> 
                    <label id="replenishment-error" for ='replenishment' class ='error'></label>
                </div>
            </div>


            <div class = 'line row'>
                <input type = 'submit' value = 'Рассчитать' class='button'>
            </div>

            <div class = 'line unline'></div>
            <p class = 't1 line textp textsumma'>Сумма к оплате</p>
            <p class = 't2 line textp summaresult'>₽ 250 000</p>

        </form>
    </body>
</html>