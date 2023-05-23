if (!window.deletesubmitButton) {
  const deletesubmitButton = document.getElementById('deletesubmitBtn');
  deletesubmitButton.addEventListener('click', postData);
}

function postData() {
  var dropdown = document.getElementById("idInput");
  const idValue = document.getElementById('idInput').value;

  const data = {
    id: idValue
  };

  fetch('http://localhost/server/data/' + idValue, {
    method: 'DELETE',
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

      const selectedOption = dropdown.querySelector(`option[value="${idValue}"]`);
      selectedOption.remove();
    })
    .catch(error => {
      console.error('Error:', error);
    });
    fetchData();
}
