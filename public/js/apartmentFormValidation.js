const form = document.querySelector('form');
//campi della form
const title = document.getElementById('title');
const price = document.getElementById('price');
const description = document.getElementById('description');
const rooms_number = document.getElementById('rooms_number');
const bathrooms_number = document.getElementById('bathrooms_number');
const beds_number = document.getElementById('beds_number');
const mqs = document.getElementById('mqs');
const address = document.getElementById('address');
const addressTipsContainer = document.querySelector('.address-tips');
const latitude = document.getElementById('latitude');
const longitude = document.getElementById('longitude');
const previewImage = document.getElementById('image'); //solo edit
const imageCover = document.getElementById('image-cover');
const extraServiceContainer = document.querySelector('.extra-service');
const extraServices = document.querySelectorAll('.extra_services');
const visibilityContainer = document.querySelector('div.visibility');

//ottenere gli id dei servizi extra e i servizi già presenti(edit)
const valideServices = [];
extraServices.forEach(element => {
  valideServices.push(element.value);
});


const formBtn = document.querySelector('form button.btn');

function formSubmit(){
  const data = getData();

  //rimuovere i messaggi di errore se ci sono
  const errorMessages = document.querySelectorAll('.alert.alert-danger');
  errorMessages.forEach(element => {
    element.remove();
  });

  return validateData(data);
  
}

function getData(){
  const services = [];
  extraServices.forEach(element => {
    if(element.checked)services.push(element.value);
  });

  const visibilityValue = document.querySelector('input[name="visibility"]:checked').value;

  return {
    title: title.value,
    price: price.value,
    description: description.value,
    rooms_number: rooms_number.value,
    bathrooms_number: bathrooms_number.value,
    beds_number: beds_number.value,
    mqs: mqs.value,
    address: address.value,
    latitude: latitude.value,
    longitude: longitude.value,
    imageCover: imageCover.value,
    extraServices: services,
    visibility: visibilityValue,

  };
}

function validateData(data){
  // console.log(data);
  let validData = true;
  //controllo titolo
  if(data.title.length < 4 || data.title.length > 255){
    errorMessage(title.parentElement, 'Titolo non valido');
    // console.log('titolo non valido')
    validData = false;
  }
  // controllo prezzo
  if(data.price <= 0 || data.price > 9999.99){
    errorMessage(price.parentElement, 'Prezzo non valido');
    // console.log('prezzo non valido')
    validData = false;
  }
  // controllo descrizione
  if(data.description){
    if(data.description.length > 20000){
      errorMessage(description.parentElement, 'Descrizione troppo lunga, max:20000');
      // console.log('descrizione non valida')
      validData = false;
    }
  }
  // controllo numero di camere 
  if(data.rooms_number < 1 || data.rooms_number > 255){
    errorMessage(rooms_number.parentElement, 'Numero di stanze non valido');
    // console.log('stanze')
    validData = false;
  }
  // controllo numero di bagni
  if(data.bathrooms_number < 1 || data.bathrooms_number > 255){
    errorMessage(bathrooms_number.parentElement, 'Numero di bagni non valido');
    // console.log('bagni')
    validData = false;
  }
  //controllo numero di letti
  if(data.beds_number < 1 || data.beds_number > 255){
    errorMessage(beds_number.parentElement, 'Numero di letti non valido');
    // console.log('letti')
    validData = false;
  }
  //controllo mqs
  if(data.mqs < 10 || data.mqs > 65535){
    errorMessage(mqs.parentElement, 'Dimensioni della stanza non valide');
    // console.log('mqs')
    validData = false;
  }
  // controllo indirizzo 
  if(data.address.length < 4 || data.address.length > 255){
    errorMessage(address.parentElement, 'Indirizzo non valido');
    // console.log('indirizzo')
    validData = false;
  }
  //controllo coordinate
  if(
    !data.latitude ||
    data.latitude < -90 ||
    data.latitude > 90 ||
    !data.longitude ||
    data.longitude < -180 ||
    data.longitude > 180
    ){
    const error = document.querySelector('#address+.alert.alert-danger');
    if(error){
      error.remove();
      errorMessage(address.parentElement, 'Ops, qualcosa è andato storto, riprovare');

    }else{
      errorMessage(address.parentElement, 'Ops, qualcosa è andato storto, riprovare');
    }
    validData = false;
  }
  //controllo immagine
  const imageTypeCtrl = 
    !data.imageCover.includes('.jpg') &&
    !data.imageCover.includes('.jpeg') &&
    !data.imageCover.includes('.png') &&
    !data.imageCover.includes('.bmp') &&
    !data.imageCover.includes('.gif') &&
    !data.imageCover.includes('.svg') &&
    !data.imageCover.includes('.webp');
  if(!previewImage){ //siamo in create

    if(!data.imageCover){ //controllare se l'immagine è stata inserita
      errorMessage(imageCover.parentElement, 'Inserire un immagine');
      validData = false;
    }
  
    if(imageTypeCtrl){ //controllare che il formato sia corretto
      if(data.imageCover)errorMessage(imageCover.parentElement, 'Formato immagine non valido');
      // console.log('indirizzo')
      validData = false;
    }
  }else if(previewImage && data.imageCover){ //siamo in edit ed è stata inserita una nuova immagine
    console.log('siamo in edit')
    if(imageTypeCtrl){ //controllare che il formato sia corretto
      if(data.imageCover)errorMessage(imageCover.parentElement, 'Formato immagine non valido');
      // console.log('indirizzo')
      validData = false;
    }
  }
  // controllo dei servizi extra 
  
  let serviceMessage = null;
  if(data.extraServices.length === 0){
    // errorMessage(extraServiceContainer, 'Inserire un servizio extra');
    // console.log('inserire un servizio extra')
    serviceMessage = 'Inserire almeno un servizio extra';
    validData = false;
  }

  for(let i = 0; i < data.extraServices.length; i++){
    if(!valideServices.includes(data.extraServices[i])){
      // console.log(data.extraServices[i], '->non valido');
      serviceMessage = 'Uno dei servizi inseriti non è valido, riprovare';
      validData = false;
    }
  }
  if(serviceMessage)errorMessage(extraServiceContainer, serviceMessage);

  //controllo valore della visibilità
  if(
    data.visibility !== true &&
    data.visibility !== false &&
    data.visibility !== 'true' &&
    data.visibility !== 'false' &&
    data.visibility !== '1' &&
    data.visibility !== '0' &&
    data.visibility !== 1 &&
    data.visibility !== 0
    ){
      validData = false;
      errorMessage(visibilityContainer, "L'elemento selezionato non è valido, riprovare");
    }

  return validData;
}

function errorMessage(element, message){
  //creare il div contenente il messaggio
  const container = document.createElement('div');
  container.classList.add('alert', 'alert-danger');
  container.setAttribute('role', 'alert');
  container.innerText = message;

  //inserire il messaggio nell'elemento
  element.appendChild(container);
}

//ricerca indirizzi
let results = [];
let searchTextCtrl = address.value; //controllo per far partire l'API (iniziare ad address.value per form edit)

delete axios.defaults.headers.common['X-Requested-With'];

setInterval(callApi, 500);

function callApi(){
  if(
    address.value !== searchTextCtrl &&
    address.value !== '' &&
    address.value.length > 3
    ){
    searchTextCtrl = address.value;
    console.log('far partire api', searchTextCtrl);

    axios.get(`https://api.tomtom.com/search/2/geocode/${address.value}.json`, {
      params : {
        key : 'H97FXaSDT7RHiYR8ApDuoF894E4WPAXv',
        countrySet: 'IT'
      }
    }).then(resp => {
      results = resp.data.results;
      addSuggestions(results);
    }).catch(e => {
      console.error('Sorry! ' + e);
    });
  }
}

function addSuggestions(data){
  addressTipsContainer.innerHTML = '';

  data.forEach(element => {
    const tip = document.createElement('div');
    const addressString = `${element.address.freeformAddress}, ${element.address.countrySecondarySubdivision}, ${element.address.countrySubdivision}`
    tip.innerHTML = `<p>${addressString}</p>`;
    tip.addEventListener('click', function(){
      addressTipsContainer.innerHTML = '';
      // console.log(element.position);
      address.value = addressString; //inserire indirizzo completo nell'imput
      searchTextCtrl = addressString; //non far partire una nuova richiesta al click del tip
      latitude.value = element.position.lat;
      longitude.value = element.position.lon;
    });
    addressTipsContainer.appendChild(tip);
  });
}