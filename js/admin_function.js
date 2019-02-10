//variabili users
var nome,cognome,usern,indirizzo,cell,pwd,textUser;
var is_new_user = false;
//variabili Products
var nomeP,descrizione,categoria,consoleP,prezzo,quantita,img,id_prodotto;
var is_new_product = false;


  function selectChanged(valore){
    var obj = JSON.parse(Get("php/refreshValue.php?id_prodotto="+id_prodotto+"&console="+valore.value));
    if(obj!=''){
      document.getElementById('quantita').value=obj.free_quantity;
      document.getElementById('prezzo').value=obj.price;
    }
    else{
      document.getElementById('quantita').value="";
      document.getElementById('prezzo').value="";
    }
  }

  function tableThread(){
    setInterval("initTableConsole()",1000);
  }

  function deleteRow(){
    var id_table = document.getElementById('tableConsole');
    for(var i = id_table.rows.length - 1; i > 0; i--){
      id_table.deleteRow(i);
    }
  }

  function initTableConsole(){
    deleteRow();
    var id_table = document.getElementById('tableConsole');
    var consoleG = JSON.parse(Get("php/getAssociatedConsole.php?info=*"));
    for(var i = 0 ; i<consoleG.length ; i++){
      var tr = document.createElement('tr');
      tr.innerHTML = '<td scope="row" class="dim-50">'+consoleG[i].name+
      '</td><td align="right"><p id="'+consoleG[i].id+
      '" onclick="deleteConsole(this.id);" onmouseover="" style="cursor: pointer;"class="dim-50 x-delate">X</p></td>';
      id_table.appendChild(tr);
    }
  }

  function deleteConsole(element){
    var conf = confirm("Confermi di voler eliminare questa console?");
    if(conf){
      var Httpreq = new XMLHttpRequest();
      Httpreq.open("GET","php/deleteConsole.php?id="+element,false);
      Httpreq.send(null);
      //window.location.reload(true);
    }
  }

  function findUserData(){
    textUser = document.getElementById('textUser').value;
    var contentUser = document.getElementById('tab_utenti');
    var json_obj = JSON.parse(Get("php/getUser.php?var="+textUser));
    if(json_obj!=""){
      document.getElementById('nome').value=json_obj.name; nome = json_obj.name;
      document.getElementById('cognome').value=json_obj.surname; cognome = json_obj.name;
      document.getElementById('username').value=json_obj.username; username = json_obj.name;
      document.getElementById('indirizzo').value=json_obj.address;  indirizzo = json_obj.name;
      document.getElementById('cell').value=json_obj.phone; cell = json_obj.name;
      document.getElementById('pwd').value=json_obj.password; pwd = json_obj.name;
      contentUser.style.display = "block";
      document.getElementById('button_elimina_utente').style.display="block";
      is_new_user = false;
    }
    else{
      if(textUser!=""){
        document.getElementById('nome').value="";
        document.getElementById('cognome').value="";
        document.getElementById('username').value=""+textUser;
        document.getElementById('indirizzo').value="";
        document.getElementById('cell').value="";
        document.getElementById('pwd').value="";
        contentUser.style.display = "block";
        document.getElementById('button_elimina_utente').style.display="none";
        is_new_user = true;
      }
    }
  }

  function findProductData(){
    var textProduct = document.getElementById('textProduct').value;
    var contentProduct = document.getElementById('tab_prodotti');
    var json_obj = JSON.parse(Get("php/getProduct.php?var="+textProduct));
    var select = document.getElementById("inputGroupSelect01");
    removeOptions(select); //remove old option and create new option
    if(json_obj!=""){
      var consoleG = JSON.parse(Get("php/getAssociatedConsole.php?info=*"));
      for(var i = 0 ; i<consoleG.length ; i++){
        var elem = document.createElement("option");
        elem.text = consoleG[i].name;
        select.add(elem,elem[0]);
      }
      id_prodotto = json_obj.id;
      document.getElementById('nomeProdotto').value=json_obj.title;
      document.getElementById('categoria').value=json_obj.category;
      document.getElementById('quantita').value=json_obj.free_quantity;
      document.getElementById('descrizione').value=json_obj.description;
      document.getElementById('prezzo').value=json_obj.price;
      contentProduct.style.display="block";
      document.getElementById('button_elimina_prodotto').style.display="block";
      is_new_product = false;
    }
    else{
      if(textProduct!=""){
        var consoleG = JSON.parse(Get("php/getAssociatedConsole.php?info=*"));
        for(var i = 0 ; i<consoleG.length ; i++){
          var elem = document.createElement("option");
          elem.text = consoleG[i].name;
          select.add(elem,elem[0]);
        }
        document.getElementById('nomeProdotto').value=""+textProduct;
        document.getElementById('categoria').value="";
        document.getElementById('quantita').value="";
        document.getElementById('descrizione').value="";
        document.getElementById('prezzo').value="";
        contentProduct.style.display="block";
        document.getElementById('button_elimina_prodotto').style.display="none";
        is_new_product = true;
      }
    }
  }

  function updateProduct(){
      var conf = confirm("Confermi di voler salvare le modifiche al prodotto?");
      if(conf){
        var contentProduct = document.getElementById('tab_prodotti');
        var select = document.getElementById("inputGroupSelect01");
        nomeP = document.getElementById('nomeProdotto').value;
        descrizione = document.getElementById('descrizione').value;
        categoria = document.getElementById('categoria').value;
        consoleP = select.value;
        prezzo = document.getElementById('prezzo').value;
        quantita = document.getElementById('quantita').value;
        img = document.getElementById('exampleFormControlFile1').value;
        if(controlledOkProduct()){
          var url = "?name="+nomeP+"&description="+descrizione+
          "&category="+categoria+"&console="+consoleP+"&price="+prezzo+"&quantity="+
          quantita+"&img="+img;
          if(is_new_product){
            var Httpreq = new XMLHttpRequest();
            Httpreq.open("GET","php/newProduct.php"+url,false);
            Httpreq.send(null);
            contentProduct.style.display="none";
          }
          else{
            var Httpreq = new XMLHttpRequest();
            Httpreq.open("GET","php/setProduct.php"+url+"&id="+id_prodotto,false);
            Httpreq.send(null);
            contentProduct.style.display="none";
          }
        }
      }
  }

  function updateUser(){
    var conf = confirm("Confermi di voler salvare le modifiche all'utente?");
    if(conf){
      var contentUser = document.getElementById('tab_utenti');
      nome=document.getElementById('nome').value;
      cognome=document.getElementById('cognome').value;
      usern=document.getElementById('username').value;
      indirizzo=document.getElementById('indirizzo').value;
      cell=document.getElementById('cell').value;
      pwd=document.getElementById('pwd').value;
      if(controlledOkUser()){
        var url = "?nome="+nome+"&cognome="+cognome+"&usern="+usern+
        "&indirizzo="+indirizzo+"&cell="+cell+"&pwd="+pwd;
        if(is_new_user){
          var Httpreq = new XMLHttpRequest();
          Httpreq.open("GET","php/newUser.php"+url,false);
          Httpreq.send(null);
          contentUser.style.display = "none";
        }
        else{
          var Httpreq = new XMLHttpRequest();
          Httpreq.open("GET","php/setUser.php"+url+"&textUser="+textUser,false);
          Httpreq.send(null);
          contentUser.style.display = "none";
        }
      }
    }
  }

  function deleteProduct(){
    var conf = confirm("Confermi di voler eliminare questo prodotto?");
    if(conf){
      var contentProduct = document.getElementById('tab_prodotti');
      contentProduct.style.display="none";
      var Httpreq = new XMLHttpRequest();
      Httpreq.open("GET","php/deleteProduct.php?id="+id_prodotto,false);
      Httpreq.send(null);
      contentUser.style.display = "none";
      return Httpreq.responseText;
    }
  }

  function addConsole(){
    var contentProduct = document.getElementById('tab_prodotti');
    var name_console = document.getElementById('name_console').value;
    var conf = confirm("Confermi di voler inserire "+ name_console+"?");
    if(name_console!="" && conf){
      var Httpreq = new XMLHttpRequest();
      Httpreq.open("GET","php/addConsole.php?info="+name_console,false);
      Httpreq.send(null);
      contentProduct.style.display="none";
      //window.location.reload(true);
    }
  }

  function deleteUser(){
    var conf = confirm("Confermi di voler eliminare l'utente "+textUser+"?");
    if(conf){
      var contentUser = document.getElementById('tab_utenti');
      contentUser.style.display = "none";
      var Httpreq = new XMLHttpRequest();
      Httpreq.open("GET","php/deleteUser.php?info="+textUser,false);
      Httpreq.send(null);
      contentUser.style.display = "none";
      return Httpreq.responseText;
    }
  }

  function Get(yourUrl){
    var Httpreq = new XMLHttpRequest();
    Httpreq.open("GET",yourUrl,false);
    Httpreq.send(null);
    return Httpreq.responseText;
  }

  function removeOptions(selectbox){
    var i;
    for(i = selectbox.options.length - 1 ; i >= 0 ; i--)
    {
        selectbox.remove(i);
    }
  }

  function controlledOkUser(){
      var nome_input = document.getElementById('nome');
      var cognome_input = document.getElementById('cognome');
      var usern_input = document.getElementById('username');
      var pwd_input = document.getElementById('pwd');
      var verify_email = validateEmail(usern);
      if(nome != "" && cognome != "" &&
      usern != "" && pwd != "" && verify_email){
        nome_input.style.borderColor = '#000000';
        cognome_input.style.borderColor = '#000000';
        usern_input.style.borderColor = '#000000';
        pwd_input.style.borderColor = '#000000';
        return true;
      }
      else{
        if(nome == ""){
            nome_input.style.border='solid';
            nome_input.style.borderColor = '#e52213';
        }if(nome != ""){
            nome_input.style.border='solid';
            nome_input.style.borderColor = '#000000';
        }if(cognome == ""){
            cognome_input.style.border='solid';
            cognome_input.style.borderColor = '#e52213';
        }if(cognome != ""){
            cognome_input.style.border='solid';
            cognome_input.style.borderColor = '#000000';
        }if(usern == "" || !verify_email){
            usern_input.style.border='solid';
            usern_input.style.borderColor = '#e52213';
        }if(usern != "" && verify_email){
            usern_input.style.border='solid';
            usern_input.style.borderColor = '#000000';
        }if(pwd == ""){
            pwd_input.style.border='solid';
            pwd_input.style.borderColor = '#e52213';
        }if(pwd != ""){
            pwd_input.style.border='solid';
            pwd_input.style.borderColor = '#000000';
        }return false;
      }
  }

  function controlledOkProduct(){
    var nomeP_input = document.getElementById('nomeProdotto');
    var prezzo_input = document.getElementById('prezzo');
    var quantita_input = document.getElementById('quantita');
    if(nomeP != "" && prezzo != "" && quantita != ""){
      nomeP_input.style.borderColor = '#000000';
      prezzo_input.style.borderColor = '#000000';
      quantita_input.style.borderColor = '#000000';
      return true;
    }
    else{
      if(nomeP == ""){
        nomeP_input.style.border='solid';
        nomeP_input.style.borderColor = '#e52213';
      }if(nomeP != ""){
        nomeP_input.style.border='solid';
        nomeP_input.style.borderColor = '#000000';
      }if(prezzo == ""){
        prezzo_input.style.border='solid';
        prezzo_input.style.borderColor = '#e52213';
      }if(prezzo != ""){
        prezzo_input.style.border='solid';
        prezzo_input.style.borderColor = '#000000';
      }if(quantita == ""){
        quantita_input.style.border='solid';
        quantita_input.style.borderColor = '#e52213';
      }if(quantita != ""){
        quantita_input.style.border='solid';
        quantita_input.style.borderColor = '#000000';
      }return false;
    }
  }

  function validateEmail(email){
    var re = /^(?:[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/;
    return re.test(email);
  }
