function saveUserData(event) {
  event.preventDefault();

  const nameInput = document.getElementById("name");
  const emailInput = document.getElementById("email");
  const phoneInput = document.getElementById("phone");
  const passwordInput = document.getElementById("password");
  const addressInput = document.getElementById("address");

  const name = nameInput.value;
  const email = emailInput.value;
  const phone = phoneInput.value;
  const password = passwordInput.value;
  const address = addressInput.value;

  const namePattern = /^[a-zA-ZęóąśłżźćńĘÓĄŚŁŻŹĆŃ\s]+$/;
  const phonePattern = /^\+48\d{9}$/;

  if (!namePattern.test(name)) {
    alert("Imię może zawierać tylko litery");
    return;
  }

  if (!phonePattern.test(phone)) {
    alert("Błędny numer telefonu");
    return;
  }

  const savedUsers = JSON.parse(localStorage.getItem("users")) || [];
  const existingUser = savedUsers.find(
    (user) => user.email === email || user.phone === phone
  );

  if (existingUser) {
    alert(
      "Użytkownik z takim adresem email lub numerem telefonu już jest zarejestrowany."
    );
    return;
  }

  const user = {
    name,
    email,
    phone,
    password,
    address,
  };

  savedUsers.push(user);
  localStorage.setItem("users", JSON.stringify(savedUsers));

  alert("Jesteś zarejestrowany!");
  document.getElementById("registrationForm").reset();
}

function loginUser(event) {
  event.preventDefault();

  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");

  const email = emailInput.value;
  const password = passwordInput.value;

  const savedUsers = JSON.parse(localStorage.getItem("users")) || [];
  const user = savedUsers.find((user) => user.email === email);

  if (user && user.password === password) {
    alert("Jesteś zalogowany!");
    window.location.href = "sklepGL.php";
  } else {
    alert("Błędny email lub hasło.");
  }

  document.getElementById("loginForm").reset();
}
