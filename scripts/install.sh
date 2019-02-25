#!/bin/bash

# softwareupdate controller
CTL="${BASEURL}index.php?/module/softwareupdate/"

# Get the scripts in the proper directories
"${CURL[@]}" "${CTL}get_script/softwareupdate" -o "${MUNKIPATH}preflight.d/softwareupdate"

# Check exit status of curl
if [ $? = 0 ]; then
	# Make executable
	chmod a+x "${MUNKIPATH}preflight.d/softwareupdate"

	# Set preference to include this file in the preflight check
    setreportpref "softwareupdate" "${CACHEPATH}softwareupdate.plist"

else
	echo "Failed to download all required components!"
	rm -f "${MUNKIPATH}preflight.d/softwareupdate"

	# Signal that we had an error
	ERR=1
fi
