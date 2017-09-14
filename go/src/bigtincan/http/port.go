/**
 * load server port from environment
 * Author: willem.j.homan@gmail.com
 * Date: 13/09/17
 * Time: 12:59 PM
 */
package http

import (
	"bytes"
	"log"
	"os"
	"strconv"
	"fmt"
)
/**
 * get the port the server will run on from an env var
 */
func GetPort() int {
	var buf    bytes.Buffer
	logger := log.New(&buf, "logger: ", log.Lshortfile)

	portS:= os.Getenv("PORT")
	port, err := strconv.Atoi(portS)
	if err != nil {
		// handle error
		logger.Print("PORT environment variable must be set for web server")
		fmt.Print(&buf)
		os.Exit(2)
	}
	if port !=80 && (port < 256 || port > 65535)  {
		logger.Print("Invalid port number for web server: " + strconv.Itoa(port) + ", must be port 80 or between 256 and 65535 inclusive")
		fmt.Print(&buf)
		os.Exit(2)
	}
	return port
}