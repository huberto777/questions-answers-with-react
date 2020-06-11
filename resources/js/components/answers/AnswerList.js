import React from "react";
import AnswerItem from "./AnswerItem";
import Axios from "axios";

class AnswerList extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            answers: JSON.parse(props.answers) || null,
            auth: JSON.parse(props.auth) || null,
            editMode: false,
            count: JSON.parse(props.count),
            question: JSON.parse(props.question),
            currentEditAnswer: null
        };
        // console.log(this.state.answers[0]);
        // console.log(this.state.answers[0].is_best);
        // console.log(this.state.answers);
        // console.log(this.state.auth.avatar);
    }

    handleEditAnswer = answer => {
        this.setState({
            editMode: true,
            answer,
            currentEditAnswer: answer.id
        });
    };

    cancelEditAnswer = () => {
        this.setState({
            editMode: false,
            currentEditAnswer: null
        });
    };

    handleUpdateAnswer = updatedAnswer => {
        this.setState(prevState => ({
            answers: prevState.answers.map(answer =>
                answer.id === updatedAnswer.id ? updatedAnswer : answer
            ),
            editMode: false,
            currentEditAnswer: null
        }));
        Axios.put(
            `/questions/${this.state.question.slug}/answers/${this.state.id}`,
            updatedAnswer
        )
            .then(res => res.data)
            .catch(err => console.log(err));
    };

    handleDeleteAnswer = ({ id }) => {
        this.setState(prevState => ({
            answers: prevState.answers.map(answer => answer.id !== id),
            count: prevState.count - 1
        }));
        if (!this.state.auth) return alert("zaloguj się");

        Axios.delete(`/questions/${this.state.question.slug}/answers/${id}`)
            .then(res => res.data)
            .catch(error => console.log(error));
    };

    createButton() {
        if (!this.state.auth) return "";
        if (!this.state.editMode) {
            return (
                <a
                    href={`/questions/${
                        this.state.question.slug
                    }/answers/create`}
                    className="btn btn-block btn-outline-secondary mb-4"
                >
                    dodaj
                </a>
            );
        }
    }

    render() {
        const {
            answers,
            auth,
            count,
            create,
            editMode,
            question,
            currentEditAnswer
        } = this.state;
        const { name } = this.props;
        let classes = "btn btn-block mb-4";
        if (!create) classes += " btn-outline-secondary";
        if (create) classes += " btn-outline-danger";
        return (
            <>
                {this.createButton()}
                <div className="card-title">
                    <h3>
                        {count} {name}s
                    </h3>
                </div>
                <hr />
                {answers.map(answer => (
                    <AnswerItem
                        key={answer.id}
                        answer={answer}
                        auth={auth}
                        editMode={editMode}
                        name={name}
                        onDelete={() => this.handleDeleteAnswer(answer)}
                        onEdit={() => this.handleEditAnswer(answer)}
                        onUpdate={this.handleUpdateAnswer}
                        currentEditAnswer={currentEditAnswer}
                        onCancel={this.cancelEditAnswer}
                    />
                ))}
            </>
        );
    }
}
let answers = document.getElementById("answers").getAttribute("answers");
let auth = document.getElementById("answers").getAttribute("auth");
let name = document.getElementById("answers").getAttribute("name");
let count = document.getElementById("answers").getAttribute("count");
let question = document.getElementById("answers").getAttribute("question");

ReactDOM.render(
    <AnswerList
        answers={answers}
        auth={auth}
        name={name}
        count={count}
        question={question}
    />,
    document.getElementById("answers")
);

export default AnswerList;
