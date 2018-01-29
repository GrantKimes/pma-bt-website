import React from 'react';

export default class SubmittedIndicator extends React.Component {

    render() {
        if (this.props.successMessage === "") {
            return null;
        }
        return (

            <div className="col-md-6 col-md-offset-3">
                <div className="alert alert-info">
                    {this.props.successMessage}
                </div>
            </div>

        );
    }
}