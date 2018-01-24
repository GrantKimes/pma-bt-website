import React from 'react';

export default class DropdownInput extends React.Component {


    render() {
        return (
            <div className="form-group">
                <label htmlFor={this.props.formName} className="col-md-3 control-label">{this.props.readableName}</label>
                <div className="col-md-6">
                    <select name={this.props.formName} className="form-control" defaultValue="not-selected">
                        <option value="not-selected">{this.props.placeholder}</option>
                        {this.props.dropdownValues.map(value => 
                            <option value={value[0]}>{value[1]}</option>
                        )}
                    </select>
                </div>
            </div>

        );
    }
}