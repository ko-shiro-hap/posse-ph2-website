"use strict";

function clickFunction(selected_id, questionId, valid) {
  const selectedButton = document.getElementById(selected_id);
  const buttons = document.querySelectorAll(`.quiz${questionId}__btn`);
  const correct = document.getElementById(`js__quiz${questionId}__correct`);
  const wrong = document.getElementById(`js__quiz${questionId}__wrong`);

  buttons.forEach((element) => {
    element.style.pointerEvents = "none";
  });
  selectedButton.classList.add("js-selected");
  if (valid == 1) {
    correct.classList.add("js-on");
  } else {
    wrong.classList.add("js-on");
  }
}
