//ajax callback
function ajaxCallback(url, method, data, result, errFunc) {
    $.ajax({
        url: url,
        method: method,
        data: data,
        dataType: "json",
        success: function (response) {
            result(response);
        },
        error: function (xhr) {
            errFunc(xhr);
        }
    });
}
window.onload = () => {

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
}
$(document).ready(function () {
    $("#brojArtikala").html(getItemLS("brojArtikala"));
    function getItemLS(ime){
        return JSON.parse(localStorage.getItem(ime));
    }
    //Funkcija za setovanje podataka u local storage
    function setItemLS(ime,vrednost){
        localStorage.setItem(ime,JSON.stringify(vrednost));
    }
    let pathname = window.location.pathname;
    let url = pathname.substr(pathname.lastIndexOf('/'));
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 500, 'easeInOutExpo');
        return false;
    });
    
    // Initiate the wowjs
    new WOW().init();
    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 10) {
            $('.navbar').addClass('sticky-top');
        } else {
            $('.navbar').removeClass('sticky-top');
        }
    });

    // Dropdown on mouse hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";

    $(window).on("load resize", function () {
        if (this.matchMedia("(min-width: 992px)").matches) {
            $dropdown.hover(
                function () {
                    const $this = $(this);
                    $this.addClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "true");
                    $this.find($dropdownMenu).addClass(showClass);
                },
                function () {
                    const $this = $(this);
                    $this.removeClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "false");
                    $this.find($dropdownMenu).removeClass(showClass);
                }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });
    //Register
    function checkRegEx(inputToCheck, regEx) {
        if (!regEx.test(inputToCheck.val())) {
            $(inputToCheck).addClass("border-danger");
            $(inputToCheck).removeClass("border-dark");
            return false;
        }
        else {
            $(inputToCheck).removeClass("border-danger");
            $(inputToCheck).removeClass("border-dark");
            $(inputToCheck).addClass("border-success");
            return true;
        }
    }
    if (url == "/register.php") {
        $('#confirmPassword').keypress(function(event) {
            if (event.keyCode === 13) {
              event.preventDefault();
              $('#btnSbmReg').click();
            }
        });
        $('#password').keypress(function(event) {
            if (event.keyCode === 13) {
              event.preventDefault();
              $('#btnSbmReg').click();
            }
          });
        let errFirstName = false;
        let errLastName = false;
        let errEmail = false;
        let errPassword = false;
        let errConfirmPassword = false;

        function checkConfirmPasswd(confirmPassword, password) {
            if ((password.val() == confirmPassword.val() && (password.val() != '' && confirmPassword.val() != ''))) {
                $(confirmPassword).removeClass("border-danger");
                $(confirmPassword).removeClass("border-dark");
                $(confirmPassword).addClass("border-success");
                $("#lozinkaAlert").addClass("sakrij");
                return true;
            }
            else {
                $("#lozinkaAlert").removeClass("sakrij");
                $(confirmPassword).addClass("border-danger");
                $(confirmPassword).removeClass("border-dark");
                return false;
            }
        }
        //Check form
        $("#btnSbmReg").click(function () {
            //Check First Name
            let firstName = $("#firstName");
            let lastName = $("#lastName");
            let email = $("#email");
            let password = $("#password");
            let confirmPassword = $("#confirmPassword");
            let regExFirstName = /^[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}(\s[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}){0,1}$/;
            let regExLastName = /^[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}(\s[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}){0,1}$/;
            let regExEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            let regExPasswd = /^(?=.*[A-Z])(?=.*[!@#$%^&*()_+=[{\]};:'"|,.<>/?])(?=.{8,})\S+$/;
            errFirstName = checkRegEx(firstName, regExFirstName);
            errLastName = checkRegEx(lastName, regExLastName);
            errEmail = checkRegEx(email, regExEmail);
            errPassword = checkRegEx(password, regExPasswd);
            errConfirmPassword = checkConfirmPasswd(confirmPassword, password);
            function regSucc(response) {
                console.log(response);
                $("#verMail").text(response.poruka);
                $("#verMail").removeClass("sakrij");
            }
            function regFailed(xhr) {
                console.log(xhr);
                if (xhr.status == 422) {
                    let odg = JSON.parse(xhr.responseText);
                    $("#lozinkaAlert").text(odg.poruka);
                    $("#lozinkaAlert").removeClass("sakrij");
                }
                if (xhr.status == 409) {
                    let odg = JSON.parse(xhr.responseText);
                    $("#lozinkaAlert").text(odg.poruka);
                    $("#lozinkaAlert").removeClass("sakrij");
                }
            }
            if ((errFirstName && errLastName && errEmail && errPassword && errConfirmPassword)) {
                console.log("Hello");
                var dataforSend = {
                    "firstName": firstName.val(),
                    "lastName": lastName.val(),
                    "email": email.val(),
                    "password": password.val(),
                    "btnClicK": true
                };
                ajaxCallback("logic/reg.php", "POST", dataforSend, regSucc, regFailed);
            }
        });
    }
    //Login php
    if (url == "/login.php") {
        $('#email').keypress(function(event) {
            if (event.keyCode === 13) {
              event.preventDefault();
              $('#btnLogin').click();
            }
        });
        $('#password').keypress(function(event) {
            if (event.keyCode === 13) {
              event.preventDefault();
              $('#btnLogin').click();
            }
          });
        $("#btnLogin").click(function () {
            let regExEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            let regExPasswd = /^(?=.*[A-Z])(?=.*[!@#$%^&*()_+=[{\]};:'"|,.<>/?])(?=.{8,})\S+$/;
            let errEmail = false;
            let errPassword = false;
            let email = $("#email");
            let password = $("#password");
            errEmail = checkRegEx(email, regExEmail);
            errPassword = checkRegEx(password, regExPasswd);
            console.log(errEmail);
            console.log(errPassword);
            if (errEmail && errPassword) {
                let dataToSend = {
                    "email": email.val(),
                    "password": password.val()
                };
                ajaxCallback("logic/logovanje.php", "POST", dataToSend,checkLogResu,loginFailed);
                function checkLogResu(response) {
                    if (response.poruka == "Successful login") {
                        $(location).prop('href', 'index.php');
                    }
                }
                function loginFailed(xhr) {
                    let odg = JSON.parse(xhr.responseText);
                    $("#loginAlert").text(odg.poruka);
                    $("#loginAlert").removeClass("sakrij");
                }
            }
        })
    }
    //
    if (url == "/ins_brand.php") {
        $("#insBrandBtn").click(function () {
            let vrednost = $("#novibrend").val();
            let dataforSend = {
                "newBrend": vrednost
            };
            ajaxCallback("logic/insert_brand.php", "POST",dataforSend,succ,err)
            function succ(data) {
                console.log(data);
                location.reload();
            }
            function err(xhr) {
                console.log((xhr.responseText));
                location.reload();
            }  
        }
        )
    }
    if (url == "/ins_product.php") {
        $("#inpSlika").change(function () {
            console.log("Pozz");
            const [file] = this.files;
            if (file) {
                let ova = URL.createObjectURL(file);
                $("#slikaUpload").attr("src", ova);
            }
        })
        function checkSelect(tag) {
            if ($(tag).val() == 0) {
                $(tag).addClass("border-danger");
                $(tag).removeClass("border-dark");
                return false;
            }
            else {
                $(tag).removeClass("border-danger");
            $(tag).removeClass("border-dark");
                $(tag).addClass("border-success");
                return true;
            }
        }

        $("#btnSbmProd").click(function () {
            let errBrand = false;
            let errCategory = false;
            let errVolume = false;
            let errName = false;
            let errPrice = false;
            let errDiscount = false;
            let errImg = false;
            let regExPrName = /^(?:[A-Za-z][A-Za-z'-]*\s){0,9}[A-Za-z][A-Za-z'-]*$/;
            let regExPrice = /^\d{1,10}$/;
            let regExDiscount = /^(\d{1,10})?$/;
            let regExImg = /^.*\.((jpg)|(jpeg)|(png))$/;
            let brand = $("#brand");
            let category = $("#category");
            let volume = $("#volume");
            let prName = $("#productName");
            let price = $("#price");
            let discount = $("#discount");
            let image = $("#inpSlika");
            errBrand = checkSelect(brand);
            errCategory = checkSelect(category);
            errVolume = checkSelect(volume);
            errName = checkRegEx(prName, regExPrName);
            errPrice = checkRegEx(price, regExPrice);
            errDiscount = checkRegEx(discount, regExDiscount);
            errImg = checkRegEx(image, regExImg);
            console.log(errBrand, errCategory, errVolume, errName, errPrice, errDiscount, errImg);
            if (errName && errCategory && errVolume && errName && errPrice, errDiscount, errImg) {
                let dataSend = new FormData();
                dataSend.append('file', $(image)[0].files[0]);
                let dataNew = {
                    "brand": brand.val(),
                    "category": category.val(),
                    "volume": volume.val(),
                    "prName": prName.val(),
                    "price": price.val(),
                    "discount": discount.val()
                };
                dataSend.append('data', JSON.stringify(dataNew));
                $.ajax({
                    url: 'logic/new_product.php',
                    type: 'POST',
                    data: dataSend,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        $("#uspeh").removeClass("sakrij");
                        setTimeout(function() {
                            location.reload();
                          }, 2000);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                        console.log(jqXHR);
                        console.log(textStatus);
                    }
                  });
            }
        });

    }
    if (url == '/products.php') {
        ajaxCallback("logic/products_get.php", "POST", '', succ, errFun);
        function cenaFunk(pr) {
            if (pr.discount == null) {
               return `<b>${pr.price} &dollar;</b>`
            }
            else {
                return `<s>${pr.price} &dollar;</s><b>${pr.discount} &dollar;</b>`
            }
        }
        function ulog(pr)
        {
            if (($("#uloga").val()) == "admin") {
                return ``;
            }
            if ($("#ulogovan").val() != 1) {
                return ``;
            }
            else {
                return `<input type="button" data-id=${pr.id_product} class="btn btn-primary add-to-cart" value="Add to cart"/>`;
            }
        }
            $("#dugmeOk").click(ukloniModal);
            function ukloniModal(){
            $("#modal-container").removeClass("show");
            $("#modal-container").css({
                "z-index":"-1"
            });
        }
            function prikaziModal(){
            $("#modal-container").addClass("show");
            $("#modal-container").css({
                "z-index":"2"
            })
            ;
            setTimeout(ukloniModal,1200);
        }
        function succ(data) {
            let html = ``
            data.forEach(pr=>{
                html += `<div class="thumb-wrapper col-lg-3 col-sm-4 col-12 text-center my-3 border border border-light">   
                        <div class="img-box">
                            <img src="assets/img/products/${pr.img_path}" class="img-fluid" alt="perfume${pr.id}">									
                        </div>
                        <div class="thumb-content">
                            <h4>${pr.brand_name}</h4>	
                            <p class="text-dark two-lines">${pr.product_name}</p>
                            <p class="fw-bold border">${pr.volume}</p>								
                            <p class="item-price">${cenaFunk(pr)}</p>
                            ${ulog(pr)}
                        </div>						
                    </div> `;
            })
            if (!data.length) {
                html=`<div class="row" id="no-products"><div class="col-12 p-3 mb-2 bg-danger text-white text-center mt-5 fw-bold mx-2">No products found</div></div>`;
            }
                $("#products").html(html);
                
            $(".add-to-cart").click(prikaziModal);
            $(".add-to-cart").click(dodajUKorpu);
         }
        function errFun(err) {
            console.log(err);
        }
        $("#btnSearch").click(function () {
            var selectedKategorije = [];
            var selectedBrand = [];
            var selectedVolume = [];
            var sortValue;
            sortValue = $("#sortBy").val();
            let highPrice = $("#highPrice");
            let lowPrice = $("#lowPrice");
            let search = $("#pretraga");
        $(".kategorija:checked").each(function() {
            selectedKategorije.push($(this).val());
        }); 
        $(".brand:checked").each(function() {
            selectedBrand.push($(this).val());
        }); 
        $(".volume:checked").each(function() {
            selectedVolume.push($(this).val());
        });
            let errSearch = false;
            let errHPrice = false;
            let errLPrice = false;
            let regExSearch = /^(?:[A-Za-z][A-Za-z'-]*\s){0,9}[A-Za-z][A-Za-z'-]*$|^$/;
            let regExPrices = /^[0-9]*$/;
            errSearch = checkRegFilter(search, regExSearch);
            errHPrice = checkRegFilter(highPrice, regExPrices);
            errLPrice = checkRegFilter(lowPrice, regExPrices);
            function checkRegFilter(inputToCheck, regEx) {
                if (!regEx.test(inputToCheck.val())) {
                    $(inputToCheck).addClass("border-danger");
                    return false;
                }
                else {
                    $(inputToCheck).removeClass("border-danger");
                    return true;
                }
            }
            if (errSearch && errHPrice && errLPrice) {
                let dataforSend = {
                    "search": search.val(),
                    "lowPrice": lowPrice.val(),
                    "highPrice": highPrice.val(),
                    "categories": selectedKategorije,
                    "brands": selectedBrand,
                    "volumes": selectedVolume,
                    "sortType": sortValue
                }
                ajaxCallback("logic/filtering_products.php", "POST", dataforSend, succ, errFun);
                window.scrollTo({top: 0, behavior: 'auto'});
            }
        })
        function promeniBrojacArtikala(){
            if(localStorage.getItem("brojArtikala")==null || localStorage.getItem("brojArtikala")==""){
                localStorage.setItem("brojArtikala",1);
            }
            else{
                let brojac = parseInt(localStorage.getItem("brojArtikala"));
                brojac++;
                console.log(brojac);
                localStorage.setItem("brojArtikala",brojac);
            }
        }
        function dodajUKorpu(){
            let id = $(this).data("id");
            let proizvodiUKorpi = getItemLS("proizvodiKorpa");
            if(proizvodiUKorpi){
                if(proizvodVecUKorpi()){
                    povecajKolicinu();
                }
                else{
                    dodajProizvod();
                    promeniBrojacArtikala();
                    $("#brojArtikala").html(getItemLS("brojArtikala"));
                }
            }
            else{
                dodajPrviProizvod();
                promeniBrojacArtikala();
                $("#brojArtikala").html(getItemLS("brojArtikala"));
            }
            //Dodavanje prvog proizvoda u korpu
            function dodajPrviProizvod(){
                let pro = [];
                pro[0] ={
                    id: id,
                    kolicina:1
                };
                setItemLS("proizvodiKorpa",pro);
            }
            //Provera da li je proizvod vec u korpi
            function proizvodVecUKorpi(){
                return proizvodiUKorpi.filter(p=> p.id == id).length;
            }
            //Dodavanje novog proizvoda u korpu
            function dodajProizvod(){
                let uKorpi = getItemLS("proizvodiKorpa");
                uKorpi.push({
                    id: id,
                    kolicina : 1
                });
                setItemLS("proizvodiKorpa",uKorpi);
            }
            //Povecavanje kolicine proizvoda
            function povecajKolicinu(){
                let uKorpi = getItemLS("proizvodiKorpa");
                for(let i in uKorpi){
                    if(uKorpi[i].id ==id){
                        uKorpi[i].kolicina++;
                        break;
                    }
                }
                setItemLS("proizvodiKorpa",uKorpi);
            }
    
        }
    }
    if (url == '/cart.php') {
        let uKorpi = getItemLS("proizvodiKorpa");
        function redirektuj(){
            location.href="finish_order.php";
        }
        ispisiKorpu();
        function kolicinaUKorpi(idProizvoda) {
            for (let i = 0; i < uKorpi.length;i++) {
                if (idProizvoda == uKorpi[i].id)
                    return uKorpi[i].kolicina;
            }
        }
        function cenaProizvoda(pr) {
            if (pr.discount == null) {
                return parseFloat(pr.price);
            }
            else {
                console.log(pr.price);
                return parseFloat(pr.discount);
            }
        }
        function ispisiKorpu() {
            html = "";
            let ukupnaCena = 0;
            if (!uKorpi || uKorpi.length == 0) {
                html = `<div class="p-3 mb-2 bg-danger text-white text-center mt-5 fw-bold">Cart is empty</div>`;
                $("#prikazKorpe").html(html);
                $("#brojArtikala").html(getItemLS("brojArtikala"));
            }
            else {
                $("#brojArtikala").html(getItemLS("brojArtikala"));
                let items = getItemLS("proizvodiKorpa");
                let novi = [];
                items.forEach(function(item) {
                    novi.push(item.id);
                });
                dataforSend = {
                    "ids": novi
                };
                ajaxCallback("logic/load_cart_products.php", "POST", dataforSend, succ, errFun);
            }
            function succ(data) {
                let html = ``;
                console.log(data);
                data.forEach(pr => {
                    html += `<div class="row mx-0 my-2 align-items-center border border-3 p-2 proizvod">
                    <div class="col-4 col-lg-2">
                        <img src="assets/img/products/${pr.img_path}" class="img-fluid" alt="perfume"/>
                    </div>
                    <div class="col-8 col-lg-5">
                        <p class="fw-bold textUKorpi">${pr.brand_name+" "+pr.product_name}</p>
                    </div>
                    <div class="col-6 col-lg-3 mt-3 mt-lg-0">
                        <p>Quantity:</p>
                        <input type="number" data-id="${pr.id_product}" class="kolicina" min="1" value="${kolicinaUKorpi(pr.id_product)}" max="100">
                        <span class="fw-bold mx-2">${(cenaProizvoda(pr))*(kolicinaUKorpi(pr.id_product))}$</span>
                    </div>
                    <div class="col-6 col-lg-2 text-right">
                        <a href="#" class="btn btn-danger obrisi" data-id="${pr.id_product}">Remove</a>
                    </div>
                </div>`;
                    ukupnaCena += (cenaProizvoda(pr)) * (kolicinaUKorpi(pr.id_product));
                })
                html +=`<div class="w-100 text-end pb-5">
                            <p>
                                Price: <span id="ukupnaCena">${ukupnaCena} $</span>
                            </p>
                            <a href="#" id="naruci" class="btn btn-primary">Order</a>
                            <a href="#" id="ukloniSve" class="btn btn-danger">Remove all</a>
                        </div>`
                $("#prikazKorpe").html(html);
                $(".obrisi").click(ukloniProizvodIzKorpe);
                $(".kolicina").change(promeniKolicinu);
                $("#ukloniSve").click(ukloniSveKorpa);
                $("#naruci").click(redirektuj);
            }
            function ukloniSveKorpa(){
                uKorpi=[];
                setItemLS("proizvodiKorpa",uKorpi);
                localStorage.setItem("brojArtikala","0");
                ispisiKorpu();
            }
            function promeniKolicinu(){
                for(i=0;i<uKorpi.length;i++){
                    if(uKorpi[i].id==$(this).attr("data-id")){
                        if($(this).val()<1){
                            $(this).val(1);
                        }
                       uKorpi[i].kolicina = $(this).val();
                    }
                }
                setItemLS("proizvodiKorpa",uKorpi);
                ispisiKorpu();
            }  
            function ukloniProizvodIzKorpe(){
                for(i=0;i<uKorpi.length;i++){
                    if(uKorpi[i].id==$(this).attr("data-id")){
                        console.log($(this).attr("data-id"))
                        uKorpi.splice(i,1);
                        i--;
                    }
                }
                setItemLS("proizvodiKorpa",uKorpi);
                ispisiKorpu();
                let brojac = parseInt(localStorage.getItem("brojArtikala"));
                 brojac--;
                localStorage.setItem("brojArtikala",brojac);
                $("#brojArtikala").html(getItemLS("brojArtikala"));
                
            }
            function errFun(err) {
                console.log(err);
            }
        }
    }
    if (url == '/finish_order.php') {
        let uKorpi = getItemLS("proizvodiKorpa");
        if (uKorpi == [] || uKorpi == null || uKorpi == '') {
            location.href="products.php";
        }
        let errFirstName = false;
        let errLastName = false;
        let errCity= false;
        let errAddress = false;
        let errPhoneNumber = false;
        $("#btnSbmOrder").click(function () {
            let firstName = $("#firstName");
            let lastName = $("#lastName");
            let city = $("#city");
            let address = $("#address");
            let phoneNumber = $("#phoneNumber");
            let regExFirstName = /^[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}(\s[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}){0,1}$/;
            let regExLastName = /^[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}(\s[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}){0,1}$/;
            let regExCity = /^[a-zA-Z][a-zA-Z]*( [a-zA-Z][a-zA-Z]*){0,8}$/;
            let regExAddress = /^[a-zA-Z0-9]+( [a-zA-Z0-9]+)*$/;
            let regExPhoneNumber =/^\+?\d{1,3}[ -]?\d{3}[ -]?\d{3}[ -]?\d{4}$/;
            errFirstName = checkRegEx(firstName, regExFirstName);
            errLastName = checkRegEx(lastName, regExLastName);
            errCity = checkRegEx(city, regExCity);
            errAddress = checkRegEx(address, regExAddress);
            errPhoneNumber = checkRegEx(phoneNumber, regExPhoneNumber);
            if (errFirstName && errLastName && errCity && errAddress && errPhoneNumber) {
                console.log("Uspesno slanje");
                let dataToSend = {
                    "firstName": firstName.val(),
                    "lastName": lastName.val(),
                    "city": city.val(),
                    "address": address.val(),
                    "phoneNumber": phoneNumber.val(),
                    "products": JSON.stringify(uKorpi)
                };
                console.log(dataToSend);
                ajaxCallback("logic/insert_order.php", "POST", dataToSend, funSucc, funErr);
                function funSucc(data) {
                    console.log(data);
                    uKorpi=[];
                    setItemLS("proizvodiKorpa",uKorpi);
                    localStorage.setItem("brojArtikala", "0");
                    console.log(data);
                    $("#lozinkaAlert").html(data);
                    $("#lozinkaAlert").removeClass("sakrij");
                    setTimeout(function() {
                        location.href="products.php";;
                      }, 2000);
                }
                function funErr(data) {
                    console.log("Greska");
                    console.log(data.responseText);
                }
            }
        })
    }
    if (url == '/profile.php') {
        function checkSamePass(lozinkaNova, lozinkaNovaConfirm) {
            if (lozinkaNova.val() == lozinkaNovaConfirm.val()) {
                $(lozinkaNovaConfirm).removeClass("border-danger");
                $(lozinkaNovaConfirm).removeClass("border-dark");
                $(lozinkaNovaConfirm).addClass("border-success");
                return true;
            }
            else {
                $(lozinkaNovaConfirm).removeClass("border-dark");
                $(lozinkaNovaConfirm).addClass("border-danger");
                return false;
            }
        }
        let regExFirstName = /^[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}(\s[A-ZČĆŠĐŽ][a-zčćžđš]{2,15}){0,1}$/;
        let regExPasswd = /^(?=.*[A-Z])(?=.*[!@#$%^&*()_+=[{\]};:'"|,.<>/?])(?=.{8,})\S+$/;
        let errFirstName = false;
        let errLastName = false;
        let errCurPass = false;
        let errNewPass = false;
        let errConfNewPass = false;
        $("#btnSbmPromeni").click(function () {
            let nIme = $("#firstName");
            let nPrezime = $("#lastName");
            let lozinkaStara = $("#oldPassword");
            let lozinkaNova = $("#password");
            let lozinkaNovaConfirm = $("#confirmPassword");
            errFirstName = checkRegEx(nIme, regExFirstName);
            errLastName = checkRegEx(nPrezime, regExFirstName);
            errCurPass = checkRegEx(lozinkaStara, regExPasswd);
            if (lozinkaNova.val() == '' && lozinkaNovaConfirm.val()=='') {
                errNewPass = true;
                $(lozinkaNova).removeClass("border-dark");
                $(lozinkaNova).addClass("border-success");
            }
            else {
                errNewPass = checkRegEx(lozinkaNova, regExPasswd);
            }
            if (lozinkaNovaConfirm.val() == '' && lozinkaNova.val()=='') {
                errConfNewPass = true;
                $(lozinkaNovaConfirm).removeClass("border-dark");
                $(lozinkaNovaConfirm).addClass("border-success");
            }
            else {
                errConfNewPass = checkSamePass(lozinkaNova, lozinkaNovaConfirm);
                errConfNewPass = checkRegEx(lozinkaNovaConfirm, regExPasswd);
            }
            if (errFirstName && errLastName && errCurPass && errNewPass && errConfNewPass) {
                dataToSend = {
                    "firstName": nIme.val(),
                    "lastName": nPrezime.val(),
                    "email": $("#email").val(),
                    "oldPassword": lozinkaStara.val(),
                    "password": lozinkaNova.val(),
                    "confirmPassword": lozinkaNovaConfirm.val()
                };
                $("#lozinkaAlert").addClass("sakrij");
                $("#changeAlert").addClass("sakrij");
                ajaxCallback("logic/change_profile.php", "POST", dataToSend, funSucc, funErr);
                function funSucc(response) {
                    console.log(response);
                    $("#greske").text(response.poruka);
                    $("#greske").removeClass("text-danger");
                    $("#greske").addClass("text-success");
                    $("#greske").removeClass("sakrij");
                    setTimeout(function() {
                        location.reload();
                      }, 2000);
                }
                function funErr(xhr) {
                    console.log(xhr);
                    if (xhr.status == 422 || xhr.status == 409 || xhr.status== 401) {
                        let odg = JSON.parse(xhr.responseText);
                        console.log(odg);
                        $("#greske").text(odg.poruka);
                    }
                }
            }
        })
    }
    if (url == "/contact.php") {
        $("#btnSbm").click(function () {
            let poruka = $("#message");
            let regExPoruka = /^.{1,1000}$/;
            let id_user = $("#idUser").val();
            let errMessage = false;
            console.log(id_user);
            errMessage = checkRegEx(poruka, regExPoruka);
            if (errMessage) {
                let dataToSend = {
                    "message": poruka.val(),
                    "id_user" : id_user
                }
                ajaxCallback("logic/message_insert.php", "POST", dataToSend, funSucc, funErr);
                function funSucc(data) {
                    $("#poruka").removeClass("sakrij");
                    setTimeout(function() {
                        location.reload();
                      }, 2000);
                }
                function funErr(xhr) {
                    $("#poruka").html("Error, try again");
                    $("#poruka").removeClass("sakrij");
                    $("#poruka").removeClass("text-success");
                    $("#poruka").addClass("text-danger");
                }
            }
        })
    }
    if (url == "/poll.php") {
        console.log("Pozdrav");
        $("#btnSbmPoll").click(function () {
            let vrednost = $('input[name="rating"]:checked').val();
            if (vrednost === undefined) {
                $("#greska").removeClass("sakrij");
            }
            else {
                let dataToSend = {
                    "anketaId": $("#anketaId").val(),
                    "id_answer": vrednost
                };
                console.log(dataToSend);
                ajaxCallback("logic/save_answer.php", "POST", dataToSend, succFun, errFun);
                function errFun(data) {
                    console.log("Greska");
                }
                function succFun(data) {
                    $("#greska").addClass("sakrij");
                    $("#uspeh").removeClass("sakrij");
                    setTimeout(function() {
                        location.href="products.php";;
                      }, 2000);
                }
            }
        })
    }
})
