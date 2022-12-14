import React, {Component} from 'react';
import {Link} from 'react-router-dom';
import {loggedUserUrl, loginUrl } from "../../../utils/apiUrl";
import '../../../styles/pages/Register.css';
import {
    Button,
    Card,
    CardBody,
    CardGroup,
    Col,
    Container,
    Form,
    Input,
    InputGroup,
    InputGroupAddon,
    InputGroupText,
    Row
} from 'reactstrap';

class Login extends Component {

    state = {
        username: '',
        password: '',
        message: ''
    };

    handleChange = (e) => {
        const name = e.target.name;
        const type = e.target.type;

        if (type === "text" || type === "password") {
            const value = e.target.value;
            this.setState({
                [name]: value
            })
        }
    };

    handleSubmit = (e) => {
        e.preventDefault();
        fetch(loginUrl , {
            method: 'post',
            headers: new Headers({
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }),
            body: JSON.stringify({
                "username": this.state.username,
                "password": this.state.password
            })
        }).then(response => {
            if (response.ok) {
                response.json().then(json => {
                    sessionStorage.setItem('token', 'BEARER '.concat(json.token));
                }).then(response => {
                    fetch(loggedUserUrl, {
                        method: 'get',
                        headers: new Headers({
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'Authorization': sessionStorage.getItem('token')
                        }),
                    }).then(response => {
                    if (response.ok) {
                        response.json().then(json => {
                            sessionStorage.setItem('user', JSON.stringify({
                                    "username": json.username,
                                    "email": json.email,
                                    "role": json.role.name
                                })
                            )
                        });
                        this.props.history.push('/');
                    } else {
                        console.log(response.statusText, response.status, "Error during get logged user request");
                    }
                })})
            } else {
                this.setState({
                    username: '',
                    password: '',
                    message: 'Niepoprawne dane',
                });
                console.log(response.statusText, response.status, "Error during login request");
            }
        })
    };

    componentDidUpdate() {
        if (this.state.message !== '') {
            setTimeout(() => this.setState({
                message: ''
            }), 10000)
        }
    }

    render() {
        const {username, password} = this.state;
        return (
            <div className="app flex-row align-items-center">
                <Container>
                    <Row className="justify-content-center">
                        <Col md="8">
                            <CardGroup>
                                <Card className="p-4">
                                    <CardBody>
                                        <Form onSubmit={this.handleSubmit}>
                                            <h1>Login</h1>
                                            <p className="text-muted">Zaloguj si?? do w??asnego konta</p>
                                            <InputGroup className="mb-3">
                                                <InputGroupAddon addonType="prepend">
                                                    <InputGroupText>
                                                        <i className="icon-user"></i>
                                                    </InputGroupText>
                                                </InputGroupAddon>
                                                <Input type="text" id="user" name="username" value={username}
                                                       onChange={this.handleChange} placeholder="Nazwa u??ytkownika"
                                                       autoComplete="Nazwa u??ytkownika"/>
                                            </InputGroup>
                                            <InputGroup className="mb-4">
                                                <InputGroupAddon addonType="prepend">
                                                    <InputGroupText>
                                                        <i className="icon-lock"></i>
                                                    </InputGroupText>
                                                </InputGroupAddon>
                                                <Input type="password" id="password" name="password" value={password}
                                                       onChange={this.handleChange} placeholder="Has??o"
                                                       autoComplete="current-password"/>
                                            </InputGroup>
                                            <Row>
                                                <Col xs="6">
                                                    <Button color="primary" className="px-4">Zaloguj si??</Button>
                                                </Col>
                                                <Col xs="6" className="text-right">
                                                    <Button color="link" className="px-0">Zapomnia??e?? has??a?</Button>
                                                </Col>
                                            </Row>
                                        </Form>
                                        <div className="validation-errors">{this.state.message && <h3>{this.state.message}</h3>}</div>
                                    </CardBody>
                                </Card>
                                <Card className="text-white bg-primary py-5 d-md-down-none" style={{width: '44%'}}>
                                    <CardBody className="text-center">
                                        <div>
                                            <h2>Zarejstruj si??</h2>
                                            <p>Do????cz do nas aby mie?? mo??liwo???? prowadzania w??asnego panelu</p>
                                            <Link to="/register">
                                                <Button color="primary" className="mt-3" active
                                                        tabIndex={-1}>Rejestracja</Button>
                                            </Link>
                                        </div>
                                    </CardBody>
                                </Card>
                            </CardGroup>
                        </Col>
                    </Row>
                </Container>
            </div>
        );
    }
}

export default Login;
