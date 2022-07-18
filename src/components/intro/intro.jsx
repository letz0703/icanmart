import React from 'react';
import styles from './intro.module.css';

const Intro = () => {
  return (
    <>
      <section className={styles.intro_section} style={{height: '90vh'}}>
        {/* <div id='root'></div> */}
        <h1 className={styles.intro_heading} id='logo'>
          i.CANMART
        </h1>
        <p className={styles.intro_sub}>Shop JAPAN</p>
      </section>
      <div id='root'></div>
      <section className='content-section' data-scroll id='japan'>
        <figure className='figure'>
          <img src='./images/shop.jpg' />
        </figure>
        <div className='content'>
          <header className='header'>
            <div className='subheading orderforyou washed-red'>One Day Delivery</div>
            <h2 className='heading washed-yellow'>
              해외주문,
              <br />
              이제 다음날 받으세요
            </h2>
          </header>
          <p className='washed-green pv5'>
            아무리 해외배송이라지만 너무 오래 걸리는데... <br />
            물건은 잘 오고는 있는 걸까...
            <br />
            하나만 필요한데 배송비는 또 왜이리 비싼지...
            <br />한 두개라면 먼저 보내드리고, 저희가 주문하고 기다리겠습니다.
            <br />
          </p>
          <script src='//embed.typeform.com/next/embed.js'></script>
        </div>
      </section>
      <section className='content-section' data-scroll>
        <figure className='figure'>
          <img src='./images/price.jpg' />
        </figure>
        <div className='content'>
          <header className='header'>
            <div className='subheading'>Save Money</div>
            <h2 className='heading'>깡통시장보다 왜 싼가요?</h2>
          </header>
          <p className='paragraph'>
            고객님의 개인통관번호로 공동구매를 합니다.
            <br /> 그대신 다른 분들은 배송비를 분담하게 됩니다.
            <br /> 주문 금액은 개인통관 한도(현재 150$)를 넘지 않으므로 추가 경비는 일체 없습니다.
            <br /> 고객님께는 배송비 부담이 전혀 없으므로 저렴 할수 밖에 없습니다.
          </p>
        </div>
      </section>
      <section className='content-section' data-scroll>
        <figure className='figure'>
          <img src='./images/promise.jpg' />
        </figure>
        <div className='content'>
          <header className='header'>
            <div className='subheading black'>A Promise</div>
            <h2 className='heading'>
              반드시 지켜야할 약속,
              <br />
              일주일간 해외주문금지!
            </h2>
          </header>
          <p className='paragraph '>
            고객님께서 또 다른 해외 주문을 하실 경우. 저희쪽 주문과 같은날 통관이 될 경우 통관 한도 초과로 관세가 발생 할 수 있습니다. 이렇게 발생되는 관세는 저희가 책임지지 않습니다. 일인당 개인통관 한도에 맞추어 저희쪽 해외 주문이 이루어 지므로 절대 일주일 간은 해외 주문을 하셔서는 안됩니다. 주문 대행 상품에 대해서는 이것만 지켜 주시면 됩니다.
            <br />
            <a href='https://ct8a17jz60e.typeform.com/to/yQuR3cTY' className='btn'>
              주문조건 상세보기
            </a>
          </p>
        </div>
      </section>
    </>
  );
};

export default Intro;
