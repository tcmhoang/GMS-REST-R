import React, { Component } from "react";
import { Link, Navigate } from "react-router-dom";

class ErrorBoundary extends Component {
  state = { hasError: false, redirect: false };

  static getDerivedStateFromError() {
    return { hasError: true };
  }

  componentDidCatch(error, info) {
    console.error("Caught an error", error, info);
  }

  componentDidUpdate() {
    if (this.state.hasError)
      setTimeout(() => this.setState({ redirect: true }), 5000);
  }
  render() {
    if (this.state.redirect) return <Navigate to="/" />;
    if (this.state.hasError) {
      return (
        <div>
          There was an error with this listing. <Link to="/">Click here</Link>{" "}
          to go back to the homepage or wait 5 secs
        </div>
      );
    }
    return this.props.children;
  }
}

export default ErrorBoundary;
