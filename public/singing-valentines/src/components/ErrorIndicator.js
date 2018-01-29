import React from 'react';

export default class ErrorIndicator extends React.Component {

    render() {
        if (this.props.errorMessage === "") {
            return null;
        }
        return (

            <div className="col-md-6 col-md-offset-3">
                <div className="alert alert-danger">
                    {this.props.errorMessage}
                </div>
            </div>

        );
    }
}