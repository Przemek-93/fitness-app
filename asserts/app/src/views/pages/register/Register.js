import React, {Component} from 'react';
import {
    Button,
    Card,
    CardBody,
    Col,
    Container,
    Form,
    Input,
    InputGroup,
    InputGroupAddon,
    InputGroupText,
    Row
} from 'reactstrap';

class Register extends Component {

    registerUrl = 'http://127.0.0.1:8000/user';

    state = {
        username: '',
        email: '',
        password: '',
        message: '',
        errors: {
            username: false,
            email: false,
            password: false
        }
    };

    messages = {
        username_incorrect: "Nazwa musi być dłuższa niż 5 znaków i nie może zawierać spacji",
        email_incorrect: "Brak @ w emailu",
        password_incorrect: "Hasło musi zawierać conajmniej 5 znaków",
    };

    handleChange = (e) => {
        const name = e.target.name;
        const type = e.target.type;

        if (type === "text" || type === "password" || type === "email") {
            const value = e.target.value;
            this.setState({
                [name]: value
            })
        }
    };

    handleSubmit = (e) => {
        e.preventDefault();
        const validation = this.formValidation();
        if (validation.correct) {
            fetch(this.registerUrl, {
                method: 'post',
                body: JSON.stringify({
                    "username": this.state.username,
                    "email": this.state.email,
                    "password": this.state.password
                })
            })
                .then(response => {
                    if (response.ok) {
                        this.setState({
                            username: '',
                            email: '',
                            password: '',
                            message: 'Rejestracji przebiegła pomyślnie',
                            errors: {
                                username: false,
                                email: false,
                                password: false,
                            }
                        });
                        return response;
                    } else {
                        this.setState({
                            errors: {
                                username: !validation.username,
                                email: !validation.email,
                                password: !validation.password,
                            }
                        });
                        throw Error(response.status)
                    }
                })
        }
    };

    formValidation = () => {
        let username = false;
        let email = false;
        let password = false;
        let correct = false;

        if (this.state.username.length > 5 && this.state.username.indexOf(' ') === -1) {
            username = true;
        }
        if (this.state.email.indexOf('@') !== -1) {
            email = true;
        }
        if (this.state.password.length >= 5) {
            password = true;
        }
        if (username && email && password) {
            correct = true;
        }
        return ({
            correct,
            username,
            email,
            password
        })
    };

    componentDidUpdate() {
        if (this.state.message !== '') {
            setTimeout(() => this.setState({
                message: ''
            }), 3000)
        }
    }

    render() {
        const {username, email, password} = this.state;
        return (
            <div className="app flex-row align-items-center">
                <Container>
                    <Row className="justify-content-center">
                        <Col md="9" lg="7" xl="6">
                            <Card className="mx-4">
                                <CardBody className="p-4">
                                    <Form onSubmit={this.handleSubmit}>
                                        <h1>Rejestracja</h1>
                                        <p className="text-muted">Utwórz konto</p>
                                        <InputGroup className="mb-3">
                                            <InputGroupAddon addonType="prepend">
                                                <InputGroupText>
                                                    <i className="icon-user"></i>
                                                </InputGroupText>
                                            </InputGroupAddon>
                                            <Input type="text" id="user" name="username" value={username}
                                                   onChange={this.handleChange} placeholder="Nazwa użytkownika"
                                                   autoComplete="Nazwa użytkownika"/>
                                            {this.state.errors.username &&
                                            <span>{this.messages.username_incorrect}</span>}
                                        </InputGroup>
                                        <InputGroup className="mb-3">
                                            <InputGroupAddon addonType="prepend">
                                                <InputGroupText>@</InputGroupText>
                                            </InputGroupAddon>
                                            <Input type="email" id="email" name="email" value={email}
                                                   onChange={this.handleChange} placeholder="Email"
                                                   autoComplete="email"/>
                                            {this.state.errors.email &&
                                            <span>{this.messages.email_incorrect}</span>}
                                        </InputGroup>
                                        <InputGroup className="mb-3">
                                            <InputGroupAddon addonType="prepend">
                                                <InputGroupText>
                                                    <i className="icon-lock"></i>
                                                </InputGroupText>
                                            </InputGroupAddon>
                                            <Input type="password" id="password" name="password" value={password}
                                                   onChange={this.handleChange} placeholder="Hasło"
                                                   autoComplete="new-password"/>
                                            {this.state.errors.password &&
                                            <span>{this.messages.password_incorrect}</span>}
                                        </InputGroup>
                                        {/*<InputGroup className="mb-4">*/}
                                        {/*    <InputGroupAddon addonType="prepend">*/}
                                        {/*        <InputGroupText>*/}
                                        {/*            <i className="icon-lock"></i>*/}
                                        {/*        </InputGroupText>*/}
                                        {/*    </InputGroupAddon>*/}
                                        {/*    <Input type="password" placeholder="Powtórz hasło"*/}
                                        {/*           autoComplete="new-password"/>*/}
                                        {/*</InputGroup>*/}
                                        <Button color="success" block>Załóż konto</Button>
                                    </Form>
                                    {this.state.message && <h3>{this.state.message}</h3>}
                                </CardBody>
                            </Card>
                        </Col>
                    </Row>
                </Container>
            </div>
        );
    }
}

export default Register;
