// import React from 'react';

// import OrderEntryForm from './OrderEntryForm';

// export default class EditOrderModal extends React.Component {

//     render() {
//         console.log(this.props.orderBeingEdited);
//         if (this.props.orderBeingEdited === null) {
//             return null;
//         }

//         return (
//             <div className="modal fade" id="edit-order-modal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
//               <div className="modal-dialog" role="document">
//                 <div className="modal-content">
//                   <div className="modal-header">
//                     <h3 className="modal-title" id="exampleModalLabel">Edit Order</h3>
//                     <button type="button" className="close" data-dismiss="modal" aria-label="Close">
//                       <span aria-hidden="true">&times;</span>
//                     </button>
//                   </div>
//                   <div className="modal-body">
//                     <OrderEntryForm
//                         isEditing={true}
//                         orderBeingEdited={this.props.orderBeingEdited}
//                         orderContainer={this.props.orderContainer}>
//                     </OrderEntryForm>
//                   </div>
//                 </div>
//               </div>
//             </div>
//         );
//     }
// }