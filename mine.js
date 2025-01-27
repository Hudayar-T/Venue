

$(document).ready(function(){
// ------------------------------------ MENU --------------------------------------

    console.log(window.innerWidth);
    if (window.innerWidth <= 1050) {
        // Code to run if the screen width is 768px or smaller
        var menu_icon = document.getElementById("menu_icon");
        var menu = document.getElementById("menu");
        var mmenu = document.getElementById("mobile_menu");
        menu_icon.style.display = "block";
        mmenu.style.display = "block";
        menu.style.display="none";
    } else {
        // Code to run if the screen width is larger than 768px
        console.log('The website is opened on a large screen');
    }

    $('#menu_icon').click(function(){
        console.log(mmenu.style.height)
        if(mmenu.style.height=="0px" || mmenu.style.height=="")
        {
            menu_icon.style.transform = "rotate(360deg)";
            mmenu.style.height = mmenu.scrollHeight + "px";
        }
        else
        {
            menu_icon.style.transform = "rotate(-360deg)";
            mmenu.style.height = "0px";
        }
    })

    
// ------------------------------------ LOGIN AND REGISTER --------------------------------------

    var login_register_table = document.createElement('div')
    login_register_table.setAttribute('id', 'login_register_table')
    login_register_table.style.width = '40vw'
    login_register_table.style.minWidth = '300px'
    login_register_table.style.background = 'lightgray'
    login_register_table.style.border = 'black 2px solid'
    login_register_table.style.borderRadius = '3px'
    // login_register_table.style.textAlign = 'center'
    login_register_table.style.position = 'fixed'
    login_register_table.style.zIndex = 101

    login_register_table.innerHTML = 
    '<div id="login_table" style="display: flex; justify-content: center; flex-wrap: wrap;">' +
    '<h1 id="login_text">Вход</h1>' +
    '<err id="login_email_error"></err>' +
    '<input type="email" name="login_email" id="login_email" placeholder="Почта..." required><br>' +
    '<err id="login_password_error"></err>' +
    '<input type="password" name="login_password" id="login_password" placeholder="Пароль..." required><br>' +
    '<input type="submit" id="login_submit" name="login_submit" value="Отправить">'+
    '</div>' +

    '<div id="register_table" style="display: flex; justify-content: center; flex-wrap: wrap;">' +
    '<h1 id="register_text">Регистрация</h1>' +
    '<err id="register_name_error"></err>' +
    '<input type="text" name="register_name" id="register_name" placeholder="Полное имя..." required><br>' +
    '<err id="register_email_error"></err>' +
    '<input type="email" name="register_email" id="register_email" placeholder="Почта..." required><br>' +
    '<err id="register_password_error"></err>' +
    '<input type="password" name="register_password" id="register_password" placeholder="Пароль..." required><br>' +
    '<err id="register_pfp_error"></err>' +
    '<input id="register_pfp" type="file" onchange="handlePfpSelection()" name="register_pfp" style="display: none" accept="image/*" >' +
    '<div id="register_pfp_label"><label for="register_pfp" style="display: block; cursor: pointer; height: 100%;">Фото профиля</label></div>' +
    '<input type="submit" id="register_submit" name="register_submit" value="Отправить">' +
    '</div>'

    var style=document.createElement('style')
    style.innerText = 
    "#login_register_table input{clear:both;}"+
    "#login_register_table input, #register_pfp_label{width: 35vw; min-width: 262.5px; height: min(7vh, 10vw); margin-bottom: 3.5vh; padding: 1.6vh 0.7vw; background: white; border: 1px black solid;}" +
    "#login_register_table h1{margin-bottom: 4vh}" +
    "#login_register_table input[type='submit']{width: 10vw; margin: 0 1vw; margin-bottom: 3vh; background-color: rgb(194, 194, 194);}" +
    "err{color: red; width: 100%; text-align: center;}" +
    "#register_pfp_label{margin-bottom: 3.5vh; display: flex; align-items: center; justify-content: center;}"

    var background = document.createElement('div')
    background.setAttribute('id','login_background')
    background.style.background = 'black'
    background.style.opacity = 0.7
    background.style.width = '100vw'
    background.style.height = '100vh'
    background.style.position = 'fixed'
    background.style.zIndex = 91
    background.style.top = 0
    background.style.left = 0

    document.body.appendChild(background)
    document.body.appendChild(login_register_table)
    document.body.appendChild(style)

    CalcTopLeft();

    background.style.display = 'none'
    login_register_table.style.display = 'none'

    $('#moblogin').click(function(){ $('#login').click()})
    $('#login').click(function(){
        if(document.getElementById('login').innerText == 'Выйти' ||
           document.getElementById('moblogin').innerText == 'Выйти')
        {
            if(confirm('Вы уверены что хотите выйти из аккаунта?'))
            {
                $.post('sheet.php',
                {
                    logout: 'yes'
                },
                function(data)
                {
                    location.reload();
                })
            }
            
        }
        else{
            $('#login_register_table').show()
            $('#login_background').show()
            $('#login_table').show()
            $('#register_table').hide()
            CalcTopLeft()
            ErrHide()
        }
    })

    $('#mobregister').click(function(){$('#register').click()})
    $('#register').click(function(){
        $('#login_register_table').show()
        $('#login_background').show()
        $("#register_table").show()
        $("#login_table").hide()
        ErrHide()
        CalcTopLeft()
        console.log(document.getElementById('register_table'))
    })

    $('#login_background').click(function(){
        $('#login_register_table').hide()
        $('#login_background').hide()
        ErrHide()
    })

    $('#login_submit').click(function(){
        var email = document.getElementById('login_email'),
            password = document.getElementById('login_password');

        var email_error = document.getElementById('login_email_error'),
            password_error = document.getElementById('login_password_error');
        
        ErrHide()

        if(CheckEmail(email, email_error) && CheckPassword(password, password_error))
        {
            $.post('sheet.php',
            {
                login_email: email.value,
                login_password: password.value,
                login_submit: 'Submit'
            },
            function(data)
            {
                if(data == 'refresh') location.reload()
                else alert('Email or password is incorrect')
            })
        }
    })

    $('#register_submit').click(function(){
        ErrHide()

        var email = document.getElementById('register_email'),
            name = document.getElementById('register_name'),
            password = document.getElementById('register_password'),
            pfp = $('#register_pfp').prop('files');

        var email_error = document.getElementById('register_email_error'),
            name_error = document.getElementById('register_name_error'),
            password_error = document.getElementById('register_password_error'),
            pfp_error = document.getElementById('register_pfp_error');

        if(CheckName(name, name_error) && CheckEmail(email, email_error) && CheckPassword(password, password_error) && CheckPfP(pfp, pfp_error))
        {
            // alert('everything correct')
            var form_data = new FormData();                  
            if(pfp != undefined)form_data.append('pfp', pfp);
            form_data.append('register_email', email.value)
            form_data.append('register_name', name.value)
            form_data.append('register_password', password.value)
            form_data.append('register_submit', 'Submit')
            console.log(form_data);                             
            $.ajax({
                url: 'sheet.php', // <-- point to server-side PHP script 
                dataType: 'text',  // <-- what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                       
                type: 'post',
                success: function(php_script_response){
                    if(php_script_response == '')
                    {
                        $('#login_email').val('')
                        $('#login_password').val('')
                        $('#register_name').val('')
                        $('#register_email').val('')
                        $('#register_password').val('')
                        $('#register_text').html('Успешно!')
                        $('#register_text').css("color", "green")
                        setTimeout(function(){
                            $('#register_text').html('Register')
                            $('#register_text').css("color", "black")
                            $('#login_background').click()
                            setTimeout(function(){
                                $('#login').click()
                            }, 800)
                        }, 900)
                    }
                    else if(php_script_response == 'email_1')
                    {
                        email_error.innerText = 'Аккаунт с такой почтой уже существует';
                        document.getElementById('email').style.border = '1px solid red';
                    }
                    else console.log(php_script_response)
                }
            });
        }
    })

    const login_password = document.getElementById('login_password');
    const register_password = document.getElementById('register_password');

    login_password.addEventListener('keydown', function(event) {
        if (event.key === 'Enter' || event.keyCode === 13) {
            $('#login_submit').click()
        }
    });
    register_password.addEventListener('keydown', function(event) {
        if (event.key === 'Enter' || event.keyCode === 13) {
            $('#register_submit').click()
        }
    });

    var topp = document.getElementById('top')
    var wrap = document.getElementById('wrap')
    topp.style.minHeight = (window.innerHeight - wrap.offsetHeight) + 'px';
})

function CheckName(name, name_err)
{
    //----------------------------------- CORRECTING FULL NAME ------------------------------------
    if(name.value == '' && name.style.display != 'none')
    {
        name_err.innerText = 'Имя не может быть пустым';
        name.style.border = '1px solid red';
        return 0;
    }

    else if(name.value.length < 3 && name.style.display != 'none')
    {
        name_err.innerText = 'Имя слишком короткое'
        name.style.border = '1px solid red';
        return 0;
    }

    else if(name.value.length > 30 && name.style.display != 'none')
    {
        name_err.innerText = 'Имя слишком длинное';
        name.style.border = '1px solid red';
        return 0;
    }

    return 1;
}

function CheckEmail(email, email_error)
{
    //--------------------------------- CORRECTING EMAIL ------------------------------------
    const validateEmail = (email) => {
        return email.match(
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    };
    if(!validateEmail(email.value))
    {
        email_error.innerText = 'Некорректная почта'
        email.style.border = '1px solid red';
        return 0;
    }
    return 1;
}

function CheckPassword(password, password_error)
{
    //--------------------------------- CORRECTING PASSWORD ------------------------------------
    if(password.value == '')
    {
        password_error.innerText = 'Пароль не может быть пустым'
        password.style.border = '1px solid red';
        return 0;
    }

    else if(password.value.length < 8)
    {
        password_error.innerText = 'Пароль должен содержать не менее 8 символов'
        password.style.border = '1px solid red';
        return 0;
    }

    else if(password.value.length > 16)
    {
        password_error.innerText = 'Пароль должен содержать менее 16 символов'
        password.style.border = '1px solid red';
        return 0;
    }
    return 1;
}

function CheckPfP(pfp, pfp_error)
{
    //---------------------------------- CORRECTING FILE ----------------------------------
    console.log(pfp)
    if(pfp.length == 0) return 1;
    pfp=pfp[0];
    var extensions = ['tif', 'tiff', 'bmp', 'jpg', 'JPG', 'JPEG', 'jpeg', 'gif', 'png', 'eps', 'raw', 'cr2', 'nef', 'orf', 'sr2', 'ico', 'webp', 'pjp', 'jfif', 'jxl']
    if(!extensions.includes(pfp.name.substring(pfp.name.lastIndexOf('.')+1, pfp.name.length).toLowerCase()))
    {
        pfp_error.innerText = 'Выбранный файл не является фотографией'
        document.getElementById('register_pfp_label').style.border = '1px solid red';
        return 0;
    }
    return 1;
}

function ErrHide()
{
    $('#login_email_error').html('')
    $('#login_password_error').html('')
    $('#register_name_error').html('')
    $('#register_email_error').html('')
    $('#register_password_error').html('')
    $('#register_pfp_error').html('')
    document.getElementById('login_email').style.border = '1px solid black'
    document.getElementById('login_password').style.border = '1px solid black'
    document.getElementById('register_name').style.border = '1px solid black'
    document.getElementById('register_email').style.border = '1px solid black'
    document.getElementById('register_password').style.border = '1px solid black'
    document.getElementById('register_pfp_label').style.border = '1px solid black'
    document.getElementById('register_pfp_label').children[0].innerHTML = 'Фото Профиля'
}
function Search(string, char)
{
    for(var i=0; i<string.length; i++)
    {
        if(string[i] == char) return i
    }
    return -1
}
function CalcTopLeft()
{
    var login_register_table = document.getElementById('login_register_table') 
    var width = login_register_table.offsetWidth
    var height = login_register_table.offsetHeight
    login_register_table.style.top = (window.innerHeight/2 - height/2) + 'px'
    login_register_table.style.left = (window.innerWidth/2 - width/2) + 'px'
}
function handlePfpSelection()
{
    let label = document.getElementById("register_pfp_label");
    label.children[0].innerHTML="<b style='color: green'>Выбрано</b>";
}