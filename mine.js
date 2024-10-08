<<<<<<< HEAD
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
=======


$(document).ready(function(){
    
// ------------------------------------ LOGIN AND REGISTER --------------------------------------

    var login_register_table = document.createElement('div')
    login_register_table.setAttribute('id', 'login_register_table')
    login_register_table.style.width = '40vw'
    login_register_table.style.minWidth = '300px'
    login_register_table.style.background = 'lightgray'
    login_register_table.style.border = 'black 2px solid'
    login_register_table.style.borderRadius = '3px'
    login_register_table.style.textAlign = 'center'
    login_register_table.style.position = 'fixed'
    login_register_table.style.zIndex = 11

    login_register_table.innerHTML = 
    '<div id="login_table">' +
    '<h1 id="login_text">Login</h1>' +
    '<err id="login_email_error"></err>' +
    '<input type="email" name="login_email" id="login_email" placeholder="Email..." required><br>' +
    '<err id="login_password_error"></err>' +
    '<input type="password" name="login_password" id="login_password" placeholder="Password..." required><br>' +
    '<input type="submit" id="login_submit" name="login_submit" value="Submit">'+
    '</div>' +

    '<div id="register_table">' +
    '<h1 id="register_text">Register</h1>' +
    '<err id="register_name_error"></err>' +
    '<input type="text" name="register_name" id="register_name" placeholder="Full name..." required><br>' +
    '<err id="register_email_error"></err>' +
    '<input type="email" name="register_email" id="register_email" placeholder="Email..." required><br>' +
    '<err id="register_password_error"></err>' +
    '<input type="password" name="register_password" id="register_password" placeholder="Password..." required><br>' +
    '<err id="register_pfp_error"></err>' +
    '<input id="register_pfp" type="file" onchange="handlePfpSelection()" name="register_pfp" style="display: none" accept="image/*" >' +
    '<div id="register_pfp_label"><label for="register_pfp" style="display: block; cursor: pointer; height: 100%;">Profile Picture</label></div>' +
    '<input type="submit" id="register_submit" name="register_submit" value="Submit">' +
    '</div>'

    var style=document.createElement('style')
    style.innerText = 
    "#login_register_table input{clear:both;}"+
    "#login_register_table input, #register_pfp_label{width: 35vw; min-width: 262.5px; height: 7vh; margin-bottom: 3.5vh; padding: 1.6vh 0.7vw; background: white; border: 1px black solid;}" +
    "#login_register_table h1{margin-bottom: 4vh}" +
    "#login_register_table input[type='submit']{width: 10vw; margin: 0 1vw; margin-bottom: 3vh; background-color: rgb(194, 194, 194);}" +
    "err{color: red;}" +
    "#register_pfp_label{margin: 0 calc(50% - calc(35vw/2)); margin-bottom: 3.5vh;}"
>>>>>>> master

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
<<<<<<< HEAD
    document.body.appendChild(login_table)
=======
    document.body.appendChild(login_register_table)
>>>>>>> master
    document.body.appendChild(style)

    CalcTopLeft();

    background.style.display = 'none'
<<<<<<< HEAD
    login_table.style.display = 'none'
=======
    login_register_table.style.display = 'none'
>>>>>>> master

    $('#login').click(function(){
        if(document.getElementById('login').innerText == 'Log out')
        {
<<<<<<< HEAD
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
=======
            if(confirm('Are you sure you want to log out?'))
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
>>>>>>> master
            CalcTopLeft()
            ErrHide()
        }
    })

<<<<<<< HEAD
    $('#login_background').click(function(){
        $('#login_table').hide()
=======
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
>>>>>>> master
        $('#login_background').hide()
        ErrHide()
    })

<<<<<<< HEAD
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
=======
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
                        $('#register_text').html('Success!')
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
                        email_error.innerText = 'This email is already in use';
                        document.getElementById('email').style.border = '1px solid red';
                    }
                    else alert(php_script_response)
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

>>>>>>> master
    var topp = document.getElementById('top')
    var wrap = document.getElementById('wrap')
    topp.style.minHeight = (window.innerHeight - wrap.offsetHeight) + 'px';
})

<<<<<<< HEAD
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
=======
function CheckName(name, name_err)
{
    //----------------------------------- CORRECTING FULL NAME ------------------------------------
    if(name.value == '' && name.style.display != 'none')
    {
        name_err.innerText = 'Name can\'t be empty';
        name.style.border = '1px solid red';
        return 0;
    }

    else if(name.value.length < 3 && name.style.display != 'none')
    {
        name_err.innerText = 'Name is too short'
        name.style.border = '1px solid red';
        return 0;
    }

    else if(name.value.length > 30 && name.style.display != 'none')
    {
        name_err.innerText = 'Name is too long';
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
        email_error.innerText = 'Invalid email'
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
        password_error.innerText = 'Password can\'t be empty'
        password.style.border = '1px solid red';
        return 0;
    }

    else if(password.value.length < 8)
    {
        password_error.innerText = 'Password can\'t be less than 8 characters'
        password.style.border = '1px solid red';
        return 0;
    }

    else if(password.value.length > 16)
    {
        password_error.innerText = 'Password can\'t be more than 16 characters'
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
        pfp_error.innerText = 'This file is not an image'
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
    document.getElementById('register_pfp_label').children[0].innerHTML = 'Profile Picture'
>>>>>>> master
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
<<<<<<< HEAD
    var login_table = document.getElementById('login_table') 
    var width = login_table.offsetWidth
    var height = login_table.offsetHeight
    login_table.style.top = (window.innerHeight/2 - height/2) + 'px'
    login_table.style.left = (window.innerWidth/2 - width/2) + 'px'
=======
    var login_register_table = document.getElementById('login_register_table') 
    var width = login_register_table.offsetWidth
    var height = login_register_table.offsetHeight
    login_register_table.style.top = (window.innerHeight/2 - height/2) + 'px'
    login_register_table.style.left = (window.innerWidth/2 - width/2) + 'px'
}
function handlePfpSelection()
{
    let label = document.getElementById("register_pfp_label");
    label.children[0].innerHTML="<b style='color: green'>Selected</b>";
>>>>>>> master
}