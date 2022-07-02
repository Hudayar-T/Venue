$(document).ready(function(){

// ------------------------------------ LOGIN AND REGISTER --------------------------------------

    var login_table = document.createElement('div')
    login_table.setAttribute('id', 'login_table')
    login_table.style.width = '40vw'
    login_table.style.background = 'lightgray'
    login_table.style.border = 'black 2px solid'
    login_table.style.borderRadius = '3px'
    login_table.style.textAlign = 'center'
    login_table.style.position = 'fixed'
    login_table.style.zIndex = 11

    login_table.innerHTML = 
    '<h1 id="login_text">Login table</h1>' +
    '<err id="full_name_error"></err>' +
    '<input type="text" style="display: none;" name="register_name" id="full_name" placeholder="Full name..." required><br>' +
    '<err id="email_error"></err>' +
    '<input type="email" name="login_email" id="email" placeholder="Email..." required><br>' +
    '<err id="password_error"></err>' +
    '<input type="password" name="login_password" id="password" placeholder="Password..." required><br>' +
    '<err id="pfp_error"></err>' +
    '<input id="pfp" type="file" name="pfp" palceholder="Profile picture" style="display: none" accept="image/*" >' +
    '<div style="display: none;" id="pfp_label"><label for="pfp" style="display: block; cursor: pointer;">Profile Picture</label></div>' +
    '<input type="submit" id="login_submit" value="Submit">' +
    '<button id="register_button">Register</button>'

    var style=document.createElement('style')
    style.innerText = 
    "#login_table input, #register_button, #login_button, #pfp_label{width: 35vw; height: 7vh; margin-bottom: 3.5vh; padding: 1.6vh 0.7vw; background: white; border: 1px black solid;}" +
    "#login_table h1{margin-bottom: 4vh}" +
    "#login_table input[type='submit'], #register_button, #login_button{width: 10vw; margin: 0 1vw; margin-bottom: 3vh; background-color: rgb(194, 194, 194);}" +
    "err{color: red;}" +
    "#pfp_label{margin: 0 calc(50% - calc(35vw/2)); margin-bottom: 3.5vh;}"

    var background = document.createElement('div')
    background.setAttribute('id','login_background')
    background.style.background = 'black'
    background.style.opacity = 0.7
    background.style.width = '100vw'
    background.style.height = '100vh'
    background.style.position = 'fixed'
    background.style.zIndex = 10
    background.style.top = 0
    background.style.left = 0

    document.body.appendChild(background)
    document.body.appendChild(login_table)
    document.body.appendChild(style)

    CalcTopLeft();

    background.style.display = 'none'
    login_table.style.display = 'none'

    $('#login').click(function(){
        if(document.getElementById('login').innerText == 'Log out')
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
        else{
            $('#login_table').show()
            $('#login_background').show()
            CalcTopLeft()
            ErrHide()
        }
    })

    $('#login_background').click(function(){
        $('#login_table').hide()
        $('#login_background').hide()
        ErrHide()
    })

    document.getElementById('register_button').onclick = function(){
        
        if(this.id == 'register_button')
        {
            $('#login_text').html('Register table')
            $('#full_name').show()
            $('#pfp_label').show()
            $('#register_button').html('Login')
            document.getElementById('register_button').id = 'login_button'
            document.getElementById('email').setAttribute('name', 'register_email')
            document.getElementById('password').setAttribute('name', 'register_password')
        }
        else
        {
            $('#login_text').html('Login table')
            $('#full_name').hide()
            $('#pfp_label').hide()
            $('#login_button').html('Register')
            document.getElementById('login_button').id = 'register_button'
            document.getElementById('email').setAttribute('name', 'login_email')
            document.getElementById('password').setAttribute('name', 'login_password')    
        }
        ErrHide()
        CalcTopLeft()
    }

    $('#login_submit').click(function(){
        var email = document.getElementById('email'),
            name = document.getElementById('full_name'),
            password = document.getElementById('password');
        var email_error = document.getElementById('email_error')
        var name_error = document.getElementById('full_name_error')
        var password_error = document.getElementById('password_error')
        var pfp = $('#pfp').prop('files')[0];
        var pfp_error = document.getElementById('pfp_error')
        ErrHide()
        //console.log(name.value)
        //console.log(email.value)
        //console.log(password.value)
//----------------------------------- CORRECTING FULL NAME ------------------------------------
        if(name.value == '' && name.style.display != 'none')
            name_error.innerText = 'Name can\'t be empty'

        else if(name.value.length < 3 && name.style.display != 'none')
            name_error.innerText = 'Name is too short'
        
        else if(name.value.length > 30 && name.style.display != 'none')
            name_error.innerText = 'Name is too long'

//--------------------------------- CORRECTING EMAIL ------------------------------------
        if(email.value == '')
            email_error.innerText = 'Email can\'t be empty'

        else if(email.value.search('@') == -1)
            email_error.innerText = 'Missing \'@\''

        else if(email.value.search('@') == email.value.length-1)
            email_error.innerText = 'Missing part after \'@\''

        else if(email.value.search('@') == 0)
            email_error.innerText = 'Missing part before \'@\''
        
        else if(Search(email.value, '.') == -1)
            email_error.innerText = 'Missing dot'
        
        else if(email.value[email.value.search('@')+1] == '.')
            email_error.innerText = 'Missing part before dot'

        else if(Search(email.value, '.') == email.value.length-1) 
            email_error.innerText = 'Missing part after dot'

//--------------------------------- CORRECTING PASSWORD ------------------------------------
        if(password.value == '')
            password_error.innerText = 'Password can\'t be empty'
        
        else if(password.value.length < 8)
            password_error.innerText = 'Password can\'t be less than 8 characters'

        else if(password.value.length > 16)
            password_error.innerText = 'Password can\'t be more than 16 characters'

//---------------------------------- CORRECTING FILE ----------------------------------
        var extensions = ['tif', 'tiff', 'bmp', 'jpg', 'jpeg', 'gif', 'png', 'eps', 'raw', 'cr2', 'nef', 'orf', 'sr2', 'ico', 'webp', 'pjp', 'jfif', 'jxl']
        if(pfp != undefined && !extensions.includes(pfp.name.substring(pfp.name.lastIndexOf('.')+1, pfp.name.length).toLowerCase()))
            pfp_error.innerText = 'This file is not an image'
        

//------------------------------------ CORRECTING BORDER ------------------------------------
var enter = 1;
        if(document.getElementById('full_name_error').innerText != '')
            document.getElementById('full_name').style.border = '1px solid red', enter=0;

        if(document.getElementById('password_error').innerText != '')
            document.getElementById('password').style.border = '1px solid red',enter=0;

        if(document.getElementById('email_error').innerText != '')
            document.getElementById('email').style.border = '1px solid red',enter=0;
        
        if(document.getElementById('pfp_error').innerText != '')
            document.getElementById('pfp').style.border = '1px solid red',enter=0;

        if(enter)
        {
            if(email.getAttribute('name') == 'register_email')
            { 
                var form_data = new FormData();                  
                if(pfp != undefined)form_data.append('pfp', pfp);
                form_data.append('register_email', email.value)
                form_data.append('full_name', name.value)
                form_data.append('register_password', password.value)
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
                        if(php_script_response != '')
                        {
                            email_error.innerText = php_script_response; // <-- display response from the PHP script, if any
                            document.getElementById('email').style.border = '1px solid red';
                        }
                        else
                        {
                            $('#login_button').click();
                        }
                    }
                });
            }
            else
            {
                $.post('sheet.php',
                {
                    login_email: email.value,
                    login_password: password.value
                },
                function(data)
                {
                    if(data == 'refresh') location.reload()
                })
            }
        }
    })
    var topp = document.getElementById('top')
    var wrap = document.getElementById('wrap')
    topp.style.minHeight = (window.innerHeight - wrap.offsetHeight) + 'px';
})

function ErrHide()
{
    $('#full_name_error').html('')
    $('#email_error').html('')
    $('#password_error').html('')
    $('#pfp_error').html('')
    document.getElementById('full_name').style.border = '1px solid black'
    document.getElementById('email').style.border = '1px solid black'
    document.getElementById('password').style.border = '1px solid black'
    document.getElementById('pfp').style.border = '1px solid black'
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
    var login_table = document.getElementById('login_table') 
    var width = login_table.offsetWidth
    var height = login_table.offsetHeight
    login_table.style.top = (window.innerHeight/2 - height/2) + 'px'
    login_table.style.left = (window.innerWidth/2 - width/2) + 'px'
}