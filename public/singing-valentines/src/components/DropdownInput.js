import React from 'react';

import Order from '../types/Order';

export default class DropdownInput extends React.Component {


    render() {
        var dropdownOptionFields = this.props.dropdownValues.map(value => <option 
                                                                                key={this.props.formName+'_'+value[0]} 
                                                                                value={value[0]}>{value[1]}
                                                                            </option>);
        if (dropdownOptionFields.length === 0 && this.props.formName === 'time') {
            dropdownOptionFields = <option value="" disabled>Select a day first</option>;
        }

        return (
            <div className="form-group">
                <label 
                    htmlFor={this.props.formName} 
                    className="col-md-3 control-label">{Order.getReadableName(this.props.formName)}
                </label>
                <div className="col-md-6">
                    <select 
                        name={this.props.formName} 
                        value={this.props.value}
                        onChange={this.props.onChange}
                        className="form-control" 
                    >
                        <option value="">{Order.getPlaceholderValue(this.props.formName)}</option>
                        {dropdownOptionFields}
                    </select>
                </div>
            </div>

        );
    }
}