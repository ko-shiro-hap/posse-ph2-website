'use strict';

{
  /**
  * ハンバーガーメニューの処理
  */

  const hamburger = document.getElementById('js-hamburger');
  const hamburgerHead = document.getElementById('js-hamburger__head')
  const hamburgerFoot = document.getElementById('js-hamburger__foot')
  const hamburgerNav = document.getElementById('js-hamburger__nav')

  /**
   * @description
   */
  hamburger.addEventListener('click', () => {
    hamburgerHead.classList.toggle('js-hamburger__head')
    hamburgerFoot.classList.toggle('js-hamburger__foot')
    hamburgerNav.classList.toggle('js-slide')
  });
}