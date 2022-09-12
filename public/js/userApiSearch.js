export function callApi(){
  if(this.address === '')this.addressResults = [];
  if(
    this.address !== this.searchTextCtrl &&
    this.address !== '' &&
    this.address.length > 3
    ){
    this.searchTextCtrl = this.address;
    // console.log('far partire api', this.searchTextCtrl);

    axios.get(`https://api.tomtom.com/search/2/geocode/${this.address}.json`, {
      params : {
        key : 'H97FXaSDT7RHiYR8ApDuoF894E4WPAXv',
        countrySet: 'IT'
      }
    }).then(resp => {
      this.addressResults = resp.data.results;
      // this.addSuggestions(resp.data.results);
    }).catch(e => {
      console.error('Sorry! ' + e);
    });
  }
};

export function getAddressString(address){
  return `${address.address.freeformAddress}, ${address.address.countrySecondarySubdivision}, ${address.address.countrySubdivision}`;
};

export function addressClick(address){
  this.addressResults = [];
  // console.log(address)
  const addressString = this.getAddressString(address);
  this.error = '';
  // console.log(this)
  this.address = addressString; //inserire indirizzo completo nell'imput
  this.searchTextCtrl = addressString; //non far partire una nuova richiesta al click del tip
  this.latitude = address.position.lat;
  this.longitude = address.position.lon;
};

export function search(){
  const checkedServices = [];
  document.querySelectorAll('.extra_services').forEach(element => {
    if(element.checked)checkedServices.push(element.value);
  });
  // console.log(checkedServices);

  const params = {
    latitude: this.latitude,
    longitude: this.longitude,
    beds: this.beds ? this.beds : 1,
    rooms: this.rooms ? this.rooms : 1,
    radius: this.radius ? this.radius : 20,
    services: JSON.stringify(checkedServices),
  };
  //parametri di validazione
  const validation = 
    !params.longitude ||
    !params.latitude ||
    params.latitude < -90 ||
    params.latitude > 90 ||
    params.longitude > 180 ||
    params.longitude < -180 ||
    params.beds < 1 ||
    params.rooms < 1 ||
    params.radius < 1
  // console.log(params);
  if(!validation){
    this.error = null;
    // console.log('cerca')
    axios
    .get('http://127.0.0.1:8000/api/search/apartments', {
      params: params
    })
    .then(resp => {
      // console.log(resp.data.data);
      if(resp.data.success){
        //ordinare l'array mettendo prima gli appartamneti in evidenza
        this.searchResults = resp.data.data;
        this.searchResults.sort((a, b) => Number(b.sponsored) - Number(a.sponsored))
        this.$emit('searchResults', this.searchResults)
      }else{
        this.error = resp.data.error;
      }

    })
  }else{
    this.error = 'Qualcosa è andato storto, riprovare'
  }
};