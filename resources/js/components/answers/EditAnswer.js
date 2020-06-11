import React, { Component } from "react";

class EditAnswer extends Component {
    state = {
        body: this.props.answer.body
    };
    handleBody = e => {
        this.setState({
            body: e.target.value
        });
    };
    update = () => {
        const { body } = this.state;
        const { answer, onUpdate } = this.props;
        if (body.length < 3) return;
        onUpdate({ ...answer, body });
    };
    render() {
        return (
            <>
                <div className="form-group">
                    <textarea
                        className="form-control"
                        rows="7"
                        type="text"
                        value={this.state.body}
                        onChange={this.handleBody}
                    />
                </div>
                <div className="form-group">
                    <button
                        type="submit"
                        className="btn btn-block btn-outline-primary"
                        onClick={this.update}
                    >
                        update
                    </button>
                    <button
                        onClick={this.props.onCancel}
                        className="btn btn-block btn-outline-danger"
                    >
                        cancel
                    </button>
                </div>
            </>
        );
    }
}

export default EditAnswer;
