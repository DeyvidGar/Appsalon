function iniciarApp(){buscarFecha(),removerAlerta()}function buscarFecha(){document.querySelector("#fecha").addEventListener("input",e=>{const t=e.target.value;window.location="?fecha="+t})}function removerAlerta(){const e=document.querySelector(".alerta");e&&setTimeout(()=>{e.remove()},3e3)}document.addEventListener("DOMContentLoaded",()=>{iniciarApp()});