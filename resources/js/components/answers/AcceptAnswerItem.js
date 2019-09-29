import React, { Component } from "react";
import axios from "axios";

class AcceptAnswerItem extends Component {
    constructor(props) {
        super(props);
        this.state = {
            isBest: props.isBest
            // id: props.answer.id
        };
        // console.log(this.state.id);
    }

    handleAccept = e => {
        e.preventDefault();
        if (!this.props.auth) return alert("zaloguj się");
        this.setState((prevState, props) => ({
            isBest: !prevState.isBest
        }));
        axios
            .post(`/answers/${this.props.answer.id}/accept`)
            .then(res => res.data)
            .catch(err => console.log(err));
    };
    renderView = () => {
        let classes = "";
        const { isBest } = this.state;
        if (isBest) classes += "vote-accepted";
        if (isBest) {
            return (
                <a
                    title="the question owner accepted this answer as best answer"
                    className={classes}
                    onClick={this.handleAccept}
                >
                    <i className="fas fa-check fa-2x"></i>
                </a>
            );
        } else {
            return (
                <a
                    title="mark this answer as best answer"
                    className={classes}
                    onClick={this.handleAccept}
                >
                    <i className="fas fa-check fa-2x"></i>
                </a>
            );
        }
    };

    render() {
        return (
            <>
                {this.renderView()}
                {/* to do policy */}
            </>
        );
    }
}

export default AcceptAnswerItem;
