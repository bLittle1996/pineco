$(document).ready( () => {
  $('.fa-minus-square-o').click( (event) => {
    $.ajax({
      url: 'http://localhost:8000/user/cart/update/' + event.target.parentElement.parentElement.id + '/-',
      method: 'PUT',
      data: {
        '_token': $('#token').val()
      },
      success: () => {
        location.reload();
      },
      error: (response) => {
        console.log(response.responseText)
      }
    });
  });

  $('.fa-plus-square-o').click( (event) => {
    $.ajax({
      url: 'http://localhost:8000/user/cart/update/' + event.target.parentElement.parentElement.id + '/+',
      method: 'PUT',
      data: {
        '_token': $('#token').val()
      },
      success: () => {
        location.reload();
      },
      error: (response) => {
        console.log(response.responseText)
      }
    });
  });

  $('.fa-remove').click( (event) => {
    $.ajax({
      url: 'http://localhost:8000/user/cart/delete/' + event.target.parentElement.parentElement.id,
      method: 'DELETE',
      data: {
        '_token': $('#token').val()
      },
      success: () => {
        location.reload();
      },
      error: (response) => {
        console.log(response);
      }
    });
  });
});
