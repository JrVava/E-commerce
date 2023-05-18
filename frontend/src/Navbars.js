import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { api } from "./utils/apis";
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import Container from 'react-bootstrap/Container';
import CategoryMenu from "./components.js/CategoryMenu";

const Navbars = () => {
  const [categories, setCategories] = useState([]);
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
          <Navbar.Toggle aria-controls="basic-navbar-nav" />
          <Navbar.Collapse id="basic-navbar-nav">
            <Nav className="me-auto">
              <Nav.Link as={Link} to={"./products"}>Products</Nav.Link>
              <Navbar.Toggle aria-controls="navbarNav" />
              <Navbar.Collapse id="navbarNav">
                <CategoryMenu categories={categories} />
              </Navbar.Collapse>
            </Nav>
          </Navbar.Collapse>
        </Container>
      </Navbar>
    </div>
  );
};

export default Navbars;
