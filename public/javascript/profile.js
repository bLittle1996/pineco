$(document).ready(() => {

  function getOrders() {
    $.ajax({
      url: 'http://localhost:8000/user/getOrders',
      method: 'get',
      success: (data) => {
        populateOrdersTable(data)
      },
      error: () => {
        populateOrdersTable(null)
      }
    })
  }

  function populateOrdersTable(data) {
    if(data.length != 0) {
      let ordersTable = $('#orders-table')
      ordersTable.text('')//remove ;you dont have orders; message
      let rowsToAdd = '';
      data.forEach((item, index) => {
        rowsToAdd += '<tr class="populated-row"><td>' + item.id + '</td><td>' + item.created_at.substring(0, 10) + '</td><td>' + item.order_details.length + ' (' + item.order_details.reduce((total, product) => { return total + product.quantity }, 0) + ')' + '</td><td>$' + item.total_paid + '</td></tr>'
      })
      ordersTable.append("<table><tr><td>Order #</td><td>Date Purchased</td><td>Products Bought<br>(Total Quantity)</td><td>Price Paid</td></tr>" + rowsToAdd + "</table>")
    }
  }

  getOrders()
});
