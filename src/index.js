import ScrollOut from 'scroll-out';
import Splitting from 'splitting';
import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './app';
console.clear();

ScrollOut({
  cssProps: {
    visibleY: true,
    viewportY: true
  }
});

Splitting({target: '.heading'});
const root = ReactDOM.createRoot(document.getElementById('root'));

root.render(
  // <React.StrictMode>
  <App />
  // </React.StrictMode>
);
