import {BrowserRouter, Switch, Route} from 'react-router-dom';
import Home from './components/home';
import Profile from './components/profile';
import React, {Component} from 'react';
import ScrollOut from 'scroll-out';
// scrollout lecture : https://www.youtube.com/watch?v=m-MpXGFKomE
import styles from './app.module.css';

export default class App extends Component {
  componentDidMount() {
    this.so = ScrollOut({
      scope: this.$el
    });
  }

  componentWillUnmount() {
    this.so.teardown();
  }

  render() {
    return (
      <>
        <section data-scroll>
          <div className={styles.page}>
            <h1>shop JAPAN</h1>
            <p
              className='${styles.text} ${styles.text--random} f1 pb3 gray'
              data-scroll='out'
              data-splitting=''
            >
              Order For You{' '}
            </p>
            <div className='f2'>
              <ul>
                <li>일본 주문대행.</li>
                <li>물건은 다음날 받으세요!</li>
              </ul>
            </div>
            <p className='black pt4 description'>
              일본 쇼핑몰에 주문을 하면 최소 일주일에서 보름이 지나야 상품을
              받습니다. 배송비도 엄청나지요.
              <br /> 한두개만 주문하신다면 저희가 먼저 물건을 보내 드리겠습니다.
              <br /> 주문하고 기다리는 것은 저희가 하겠습니다.
            </p>
            <button href='#' className='bg-red white pv3 mt2 ph3 f3'>
              주문대행 조건 상세보기
            </button>
          </div>
        </section>
        <section data-scroll>
          <div className={styles.page}>
            <h1>buy TOGETHER</h1>
            <div
              className='${styles.text} ${styles.text--random} f1 pb3 ${styles.gonggoo}'
              data-scroll='out'
              data-splitting=''
            >
              order 0909{' '}
            </div>
            <div className='f3'>
              관심있는 상품을 올리고 함께 공동구매(준비중)
            </div>
          </div>
        </section>

        <BrowserRouter>
          <Switch>
            <Route path='/home'>
              <Home />
            </Route>
            <Route path='/profile'>
              <Profile />
            </Route>
          </Switch>
        </BrowserRouter>
      </>
    );
  }
}
