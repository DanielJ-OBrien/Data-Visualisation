if (!window.editsubmitButton) {
  const editsubmitButton = document.getElementById('editsubmitBtn');
  editsubmitButton.addEventListener('click', postData);
}

function postData() {
  const idValue = document.getElementById('idInput').value;
  const kidsdrivValue = document.getElementById('kidsdrivInput').value;
  const birthValue = document.getElementById('birthInput').value;
  const ageValue = document.getElementById('ageInput').value;
  const homekidsValue = document.getElementById('homekidsInput').value;
  const yojValue = document.getElementById('yojInput').value;
  const incomeValue = document.getElementById('incomeInput').value;
  const parent1Value = document.getElementById('parent1Input').value;
  const home_valValue = document.getElementById('home_valInput').value;
  const mstatusValue = document.getElementById('mstatusInput').value;
  const genderValue = document.getElementById('genderInput').value;
  const educationValue = document.getElementById('educationInput').value;
  const occupationValue = document.getElementById('occupationInput').value;
  const travtimeValue = document.getElementById('travtimeInput').value;
  const car_useValue = document.getElementById('car_useInput').value;
  const bluebookValue = document.getElementById('bluebookInput').value;
  const tifValue = document.getElementById('tifInput').value;
  const car_typeValue = document.getElementById('car_typeInput').value;
  const red_carValue = document.getElementById('red_carInput').value;
  const oldclaimValue = document.getElementById('oldclaimInput').value;
  const clm_freqValue = document.getElementById('clm_freqInput').value;
  const revokedValue = document.getElementById('revokedInput').value;
  const mvr_ptsValue = document.getElementById('mvr_ptsInput').value;
  const clm_amtValue = document.getElementById('clm_amtInput').value;
  const car_ageValue = document.getElementById('car_ageInput').value;
  const claim_flagValue = document.getElementById('claim_flagInput').value;
  const urbanicityValue = document.getElementById('urbanicityInput').value;

  const data = {
    id: idValue,
    kidsdriv: kidsdrivValue,
    birth: birthValue,
    age: ageValue,
    homekids: homekidsValue,
    yoj: yojValue,
    income: incomeValue,
    parent1: parent1Value,
    home_val: home_valValue,
    mstatus: mstatusValue,
    gender: genderValue,
    education: educationValue,
    occupation: occupationValue,
    travtime: travtimeValue,
    car_use: car_useValue,
    bluebook: bluebookValue,
    tif: tifValue,
    car_type: car_typeValue,
    red_car: red_carValue,
    oldclaim: oldclaimValue,
    clm_freq: clm_freqValue,
    revoked: revokedValue,
    mvr_pts: mvr_ptsValue,
    clm_amt: clm_amtValue,
    car_age: car_ageValue,
    claim_flag: claim_flagValue,
    urbanicity: urbanicityValue
  };

  fetch('http://localhost/server/data/' + idValue, {
    method: 'PATCH',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(data),
  })
    .then(response => response.json())
    .then(result => {
      console.log(result);
      const responseMessageElement = document.getElementById('responseMessage');
      responseMessageElement.textContent = JSON.stringify(result);
    })
    .catch(error => {
      console.error('Error:', error);
    });
}
