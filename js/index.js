let pseudoElement = document.querySelector('.header-1 .choices .after-ps');
let FixedElements = document.querySelector('.header-1 .choices');
let nvBorderMove = document.querySelector('.header-1 .choices .parent-ul .university .unv-border');
let UlForNvBorderMove = document.querySelector('.header-1 .choices .parent-ul .university .child-ul');

pseudoElement.addEventListener('click', function () {
  FixedElements.classList.toggle('close');
});

nvBorderMove.onclick = function () {
  UlForNvBorderMove.classList.toggle('unversity-move');
  document.querySelector('.header-1 .choices .parent-ul .university').classList.toggle('add-border');
  document.querySelector('.header-1 .choices .parent-ul .university .unv-border').classList.toggle('remove-border');
}




