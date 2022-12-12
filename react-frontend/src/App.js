/* import logo from './logo.svg';
import './App.css';

function App() {
  return (
    <div className="App">
      <header className="App-header">
        <img src={logo} className="App-logo" alt="logo" />
        <p>
          Edit <code>src/App.js</code> and save to reload.
        </p>
        <a
          className="App-link"
          href="https://reactjs.org"
          target="_blank"
          rel="noopener noreferrer"
        >
          Learn React, or not!
        </a>
      </header>
    </div>
  );
}

export default App;
*/

/*
import React from "react";
import logo from "./logo.svg";
import "./App.css";

function App() {
  const [data, setData] = React.useState(null);
  console.log(data);
  React.useEffect(() => {
    fetch("index.php")
      .then((res) => res.json())
      .then((data) => setData(data.message));
      console.log(fetch("index.php"));
  }, []);

  return (
    <div className="App">
      <header className="App-header">
        <img src={logo} className="App-logo" alt="logo" />
        { console.log(data) }
        <p>{!data ? "Loading..." : data}</p>
      </header>
    </div>
  );
}

export default App;
*/

import axios from "axios";
import React from "react";

const baseURL = "http://172.21.0.6";

export default function App() {
  const [post, setPost] = React.useState(null);

  React.useEffect(() => {
    axios.get(baseURL).then((response) => {
      setPost(response.data);
    });
  }, []);

  if (!post) return null;
  console.log(post)
  return (
    <div>
      <h1>{post.id}</h1>
      <p>{post.ISBN}</p>
    </div>
  );
}