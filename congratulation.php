<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" type="image/x-icon" href="images/barber.png" />
    <style>
      a {
        text-decoration: none;
        color: white;
      }
      body {
        min-height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      div{
          width: 35rem;
          height: 30rem;
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: space-around;
      }
      div>{
          text-align: center;
      }
      i{
          color: green;
          font-size: 5rem;
      }
    </style>
    <title>Barbershop</title>
  </head>
  <body>
    <div class="shadow-lg p-3 mb-5 bg-white rounded">
        <i class="fas fa-circle-check"></i>
      <h2 style="color: green">
        Congratultions!!! Your accound has been Created
      </h2>
      <p>
        A confirmation has been sent to your email. Please verify your account
      </p>
      <button class="btn btn-success"><a href="userLogin.php">Login</a></button>
    </div>
  </body>
</html>
