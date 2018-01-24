import React from 'react';

export default class TextInput extends React.Component {
    render() {
        return (
            <div className="form-group">
                <label htmlFor={this.props.formName} className="col-md-3 control-label">{this.props.readableName}</label>
                <div className="col-md-6">
                    <input name={this.props.formName} type="text" className="form-control"  placeholder={this.props.placeholder} />
                </div>
            </div>

        );
    }
}