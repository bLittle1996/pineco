$(document).ready( () => {
  $.get('http://localhost:8000/user/shippingInformation', (data) => {
    console.log(data)
  })
})
