import React from 'react';

const Nav = () => {
  return (
    <div>
      <nav className='navbar'>
        <div className='navbar__logo'>
          <i></i>
          <a href='https://malleable-hygienic-675.notion.site/iCANMART-c880ecec331a48babbef49269288fa5d'>i.CANMART</a>
        </div>
        <ul className='navbar__menu'>
          <li>
            <a href='#japan'>해외주문대행</a>
          </li>
          <li>공동구매</li>
          <li>깡통시장 구매대행</li>
          <li>시장 안내</li>
          <li>배송조회</li>
        </ul>
        <ul className='navbar__icons'>
          <li>
            <i className='fa-brands fa-twitter-square'></i> twitter
          </li>
          <li>
            <i className='fa-brands fa-slack'></i> slack
          </li>
          <li>
            <i className='fa-solid fa-arrow-right-to-bracket'> login</i>
          </li>
        </ul>
        <a href='#' className='navbar__toggleBtn'>
          <i className='fa-solid fa-bars'></i>
        </a>
      </nav>
    </div>
  );
};

export default Nav;
