import { Fragment, useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { api } from "./utils/apis";
import CategoryItem from "./components.js/CategoryItem";
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import Container from 'react-bootstrap/Container';
import CategoryMenu from "./components.js/CategoryMenu";

const Navbars = () => {
  const [categories, setCategories] = useState([]);
  const [loadingMenu, setLoadingMenu] = useState(true);
  const [subCategories,setSubCategories] = useState([]);
  const getCategories = async () => {
    await api.get('categories').then((response) => {
      const rootCategory = response.data.categories.find(category => category.title === 'Root');
      setCategories(rootCategory.child);
    });
  }

  useEffect(() => {
    getCategories()
  }, [])


  return (
    <div className="container">
      <Navbar bg="light" expand="lg">
        <Container>
          <Navbar.Brand as={Link} to="/">Home</Navbar.Brand>
          <Nav.Link as={Link} to={"./products"}>Products</Nav.Link>
          <Navbar.Toggle aria-controls="navbarNav" />
          <Navbar.Collapse id="navbarNav">
              <CategoryMenu categories={categories} />
          </Navbar.Collapse>
          {/* {
        categories.map((category,index) => {
            return (
                <div key={index} className="parent test">
                <CategoryItem category={category} />
                </div>
            )
        })
      } */}
        </Container>
      </Navbar>
    </div>
  );
};

export default Navbars;
