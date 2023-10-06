function formatPhoneNumber() {
    const phone = document.getElementById("phone");
    const phoneValue = phone.value;
    const numbersOnly = phoneValue.replace(/[^0-9]/g, "");
  
    if (numbersOnly.length > 3 && numbersOnly.length < 7) {
      phone.value = `${numbersOnly.slice(0, 3)}-${numbersOnly.slice(3)}`;
    } else if (numbersOnly.length >= 7) {
      phone.value = `${numbersOnly.slice(0, 3)}-${numbersOnly.slice(3, 7)}-${numbersOnly.slice(7, 11)}`;
    } else {
      phone.value = numbersOnly;
    }
  }
