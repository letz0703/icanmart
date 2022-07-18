import React, {useState} from 'react';
import styles from './app.module.css';
import Nav from './components/nav/nav';
import Intro from './components/intro/intro';

function App() {
  const [code, setCode] = useState([]);
  const icPasses = [{cell: '1815'}];

  return (
    <div class={styles.app}>
      <input type='text' className={styles.intro_input} placeholder='회원번호를 입력 하세요' onChange={(e) => setCode(e.target.value)} required />
      {icPasses.map((icPass) => {
        if (icPass.cell === code) {
          return (
            <>
              <Nav />
              <Intro />
            </>
          );
        }
      })}
    </div>
  );
}

export default App;
