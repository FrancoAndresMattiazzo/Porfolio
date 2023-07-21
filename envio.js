let a_msj_wsp = document.getElementById('WSP');

const MensajeWsp = () => {
  let nombre = document.getElementById("name").value;
  let mail = document.getElementById("exampleInputEmail1").value;
  let motivo = document.getElementById("exampleInputPassword1").value;
  let mensajeInput = document.getElementById("contenido").value;

  let mensaje_final =""

  let mensaje = "https://api.whatsapp.com/send?phone=34675071107&text=";
  console.log("Mensaje Final:", mensaje_final);
  console.log("Enlace de WhatsApp:", mensaje);

  // Utilizamos window.open() para abrir el enlace en una nueva ventana
  window.open(mensaje, "_blank");
};

a_msj_wsp.addEventListener('click', MensajeWsp);


//mensaje = "https://api.whatsapp.com/send?phone=34675071107&text="+mensaje_final 