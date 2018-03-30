'use strict';

// import Routing from './routing';
import 'bootstrap/scss/bootstrap.scss';
import $ from 'jquery';
import React from 'react';
import createReactClass from 'create-react-class';
import { Card, Button, CardHeader, CardFooter, CardBody,
    CardTitle, CardText, CardImg } from 'reactstrap';



import ReactDOM from 'react-dom';
// import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
//
// import ItemCard from './Components/ItemCard';
/*const NoteBox = ({key, author, title, avatarUrl, style, note}) => {
    return (
        <div>
        <Card>
        <CardHeader>{key}</CardHeader>
        <CardBody>
        <CardTitle>Special Title Treatment</CardTitle>
    <CardText>With supporting text below as a natural lead-in to additional content.</CardText>
    <Button>Go somewhere</Button>
    </CardBody>
    <CardFooter>{date}</CardFooter>
    </Card>

    <Card>
    <CardHeader tag="h3">Featured</CardHeader>
        <CardBody>
        <CardTitle>Special Title Treatment</CardTitle>
    <CardText>With supporting text below as a natural lead-in to additional content.</CardText>
    <Button>Go somewhere</Button>
    </CardBody>
    <CardFooter className="text-muted">Footer</CardFooter>
        </Card>
        </div>
);
};*/

class NoteSection extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            error: null,
            isLoaded: false,
            comments: []
        };
    }

    componentDidMount() {
        fetch(this.props.url, { method: 'GET', credentials: 'include' })
            .then((result) => result.json())
            .then(
                (result) => {
                    this.setState({
                        isLoaded: true,
                        comments: result.comments
                    });
                },
                // Note: it's important to handle errors here
                // instead of a catch() block so that we don't swallow
                // exceptions from actual bugs in components.
                (error) => {
                    this.setState({
                        isLoaded: true,
                        error
                    });
                }
            )
    }

    render() {
        const { error, isLoaded, comments } = this.state;
        if (error) {
            return <div>Error: {error.message}</div>;
        } else if (!isLoaded) {
            return <div>Loading...</div>;
        } else {
        return (
            <div style={{ display: 'flex' }}>
        {this.state.comments.map(
            ({ id, username, avatarUri, note, date }) => (
                <Card key={id}>
                <CardHeader>{username}</CardHeader>
            <CardImg top width="100%" src={avatarUri} alt="Card image cap" />
                <CardBody>
                <CardTitle>Titelzeile</CardTitle>
        <CardText>{note}</CardText>
        </CardBody>
        <CardFooter className="text-muted">{date}</CardFooter>
        </Card>
        )
        )}
    </div>
    );
    }
    }
};

export default NoteSection;

/*
render() {
        const { error, isLoaded, comments } = this.state;
        if (error) {
            return <div>Error: {error.message}</div>;
        } else if (!isLoaded) {
            return <div>Loading...</div>;
        } else {
        return (
            <div style={{ display: 'flex' }}>
        {this.state.comments.map(
            ({ id, username, avatarUri, note, date }) => (
                <NoteBox
            key={id}
            author={username}
            title={date}
            avatarUrl={avatarUri}
            style={{ flex: 1, margin: 10 }}
        >
            {note}
        </NoteBox>
        )
        )}
    </div>
    );
    }


fetch(this.props.url)
var NoteSection = createReactClass({
    getInitialState: function() {
        return {
            comments: []
        }
    },

    componentDidMount: function() {
        this.loadNotesFromServer();
        setInterval(this.loadNotesFromServer, 2000);
    },

    loadNotesFromServer: function() {
        $.ajax({
            url: this.props.url,
            success: function (data) {
                this.setState({comments: data.comments});
            }.bind(this)
        });
    },

    render: function() {
        return (
            <div>
            <div className="notes-container">
            <h2 className="notes-header">Kommentare</h2>
            <div><i className="fa fa-plus plus-btn"></i></div>
        </div>
        <NoteList notes={this.state.comments} />
        </div>
    );
    }
});

var NoteList = createReactClass({
    render: function() {
        if (this.props.comments) {
            var noteNodes = this.props.comments.map(function (comments) {
                return (
                    < NoteBox
                username = {comments.username}
                avatarUri = {comments.avatarUri}
                date = {comments.date}
                key = {comments.id}>
                {comments.note}
            </NoteBox>
            );
            });
        }
        return (
            <section id="cd-timeline">
            {noteNodes}
            </section>
    );
    }
});

var NoteBox = createReactClass({
    render: function() {
        return (
            <div className="cd-timeline-block">
            <div className="cd-timeline-img">
            <img src={this.props.avatarUri} className="rounded-circle" alt="Leanna!" />
            </div>
            <div className="cd-timeline-content">
            <h2><a href="#">{this.props.username}</a></h2>
        <p>{this.props.children}</p>
        <span className="cd-date">{this.props.date}</span>
        </div>
        </div>
    );
    }
});

export default NoteSection;*/
