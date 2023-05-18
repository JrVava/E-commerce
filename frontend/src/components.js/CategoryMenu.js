import React from 'react';
import {Nav,NavDropdown } from 'react-bootstrap';
export default function CategoryMenu  ({ categories }) {
    
    return (
      <Nav>
        {categories.map(category => (
          <CategoryMenuItem key={category.id} category={category} />
        ))}
      </Nav>
    );
  };
  const CategoryMenuItem = ({ category }) => {
    if (category.child && category.child.length > 0) {
      return (
        <NavDropdown title={category.title} id={`dropdown-${category.uuid}`}>
          {category.child.map(childCategory => (
            <CategoryMenuItem key={childCategory.uuid} category={childCategory} />
          ))}
        </NavDropdown>
      );
    } else {
      return (
        <Nav.Item>
          <Nav.Link href={`/category/${category.uuid}`}>{category.title}</Nav.Link>
        </Nav.Item>
      );
    }
  };