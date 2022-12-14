import logo from './logo.svg';
import './App.css';
import axios from "axios";
import React from "react";

const baseURL = "http://172.21.0.6"

export default function App() {
  const [post, setPost] = React.useState(null);

  
  React.useEffect(() => {
    axios.get(baseURL).then((response) => {
      setPost(response.data);
    });
  }, []);

  if (!post) return null;
  console.log(post);
return(
  <ol>
  {post(reptile => (
    <li key={reptile}>{reptile}</li>
  ))}
</ol>
)
/*  return (
    
    
    <div>
      <h1>a{post[0].book_name}</h1>
      <p>{post.ISBN}</p>
    </div>
  );
*/
 /*
  axios.get(baseURL, {
    params: {
      ID: 12345
    }
  })
  .then(function (response) {
    console.log(response.data);
  })
  .catch(function (error) {
    console.log(error);
  })
  .then(function () {
    // always executed
  });  
  */
}