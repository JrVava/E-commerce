import React,{useEffect, useState} from 'react'
import Navbar from './Navbar';
import { BrowserRouter, Route, Routes } from "react-router-dom";
// import Category from './components.js/Category';
import ProductByCategorySlug from './components.js/ProductByCategorySlug';
import ProductDetails from './components.js/ProductDetails';
import Home from './components.js/Home';

function App() {
  return (
    <div className="App">
      <BrowserRouter>
          <Navbar />
          <hr />
          <Routes>
          <Route path="/" element={<Home />} />
            <Route path="/category/:uuid" element={<ProductByCategorySlug />} />
            <Route path="/product-details/:uuid" element={<ProductDetails />} />
          </Routes>
        </BrowserRouter>
      {/* <Navbar/> */}
    </div>
  );
}

export default App;
