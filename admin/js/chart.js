// this will make request to the server and create a chart based on the data recieved from the server
// chart js from google is used to create the charts

$.ajax({
  method: "POST",
  url: "server/controller.php",
  dataType: "json",
  data: { request: "getChartInfo" },
  success: function (response) { // response from server
    const pendingAppt = response["pendingAppointments"]; // appointment that is pending
    const rejectedAppt = response["rejectedAppointments"]; // appointment that is rejected
    const acceptedAppt = response["acceptedAppointments"]; // appointment that is accepted
    const unverifiedCustomer = response["unverifiedCustomers"]; // customers that are unverified
    const newCustomers = response["newCustomers"]; // customer who registered today
    const services = response["services"]; // total number of services
    
    generateChart(pendingAppt,rejectedAppt,acceptedAppt,unverifiedCustomer,newCustomers,services); // function to generate chart
  },
});

function generateChart(pendingAppt,rejectedAppt,acceptedAppt,unverifiedCustomer,newCustomers,services){
  // a function to generate chart based on data
  // param:pendingappt,rejectedappt,acceptedappt,unverifiedcustomer,newcustomers,services

  google.charts.load("current", { packages: ["bar"] });
  google.charts.setOnLoadCallback(drawChart);
  
  function drawChart() { // function to draw the columns along with their names
    var data = google.visualization.arrayToDataTable([
      ["Year", "Count"],
      ["Pending Appointments", pendingAppt],
      ["Rejected Appointments", rejectedAppt],
      ["Accepted Appointments", acceptedAppt],
      ["Unverified Customers", unverifiedCustomer],
      ["New Customers", newCustomers],
      ["Services", services]
    ]);
    
  
    var options = {
      chart: {
        
      },
    };
  
    var chart = new google.charts.Bar(
      document.getElementById("columnchart_material")
    );
  
    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
}



