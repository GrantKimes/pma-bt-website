import React from 'react';

import Order from '../types/Order';

export default class TextInput extends React.Component {

    render() {
        return (
            <div className="form-group">
                <label 
                    htmlFor={this.props.formName} 
                    className="col-md-3 control-label">{Order.getReadableName(this.props.formName)}
                </label>
                <div className="col-md-6">
                    <input 
                        name={this.props.formName} 
                        value={this.props.value} 
                        placeholder={Order.getPlaceholderValue(this.props.formName)}
                        onChange={this.props.onChange}
                        type="text" 
                        className="form-control" 
                    />
                </div>
            </div>

        );
    }
}