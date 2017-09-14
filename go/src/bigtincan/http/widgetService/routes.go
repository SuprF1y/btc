/**
 * Routes for the WidgetService
 * Author: willem.j.homan@gmail.com
 * Date: 13/09/17
 * Time: 12:59 PM
 */
package widgetService

import "github.com/gorilla/mux"

func SetupRoutes(router *mux.Router){
	router.HandleFunc("/widgets/all", GetAllWidgets).Methods("GET")
	router.HandleFunc("/widgets/{id}", GetWidgetById).Methods("GET")
}