
var wtEnabled = true;

/* parseUri JS v0.1, by Steven Levithan (http://badassery.blogspot.com)
Splits any well-formed URI into the following parts (all are optional):
----------------------
? source (since the exec() method returns backreference 0 [i.e., the entire match] as key 0, we might as well use it)
? protocol (scheme)
? authority (includes both the domain and port)
    ? domain (part of the authority; can be an IP address)
    ? port (part of the authority)
? path (includes both the directory path and filename)
    ? directoryPath (part of the path; supports directories with periods, and without a trailing backslash)
    ? fileName (part of the path)
? query (does not include the leading question mark)
? anchor (fragment)
*/
function parseUri(sourceUri){
    var uriPartNames = ["source","protocol","authority","domain","port","path","directoryPath","fileName","query","anchor"];
    var uriParts = new RegExp("^(?:([^:/?#.]+):)?(?://)?(([^:/?#]*)(?::(\\d*))?)?((/(?:[^?#](?![^?#/]*\\.[^?#/.]+(?:[\\?#]|$)))*/?)?([^?#/]*))?(?:\\?([^#]*))?(?:#(.*))?").exec(sourceUri);
    var uri = {};
    
    for(var i = 0; i < 10; i++){
        uri[uriPartNames[i]] = (uriParts[i] ? uriParts[i] : "");
    }
    
    // Always end directoryPath with a trailing backslash if a path was present in the source URI
    // Note that a trailing backslash is NOT automatically inserted within or appended to the "path" key
    if(uri.directoryPath.length > 0){
        uri.directoryPath = uri.directoryPath.replace(/\/?$/, "/");
    }
    
    // Adjust path for portal
    //uri.path = getPortalUri( uri );
    
    return uri;
}

// Used to remove user specific info from portal gatewayed URIs
function getPortalUri( uri ) {
    var tempUri = uri.path;
    var index = tempUri.indexOf('PTARGS');
    if ( index != -1 ) {
        var newUri = tempUri.substring(0, index);
        tempUri = tempUri.substring(index);
        index = tempUri.indexOf('/');
        if ( index != -1 ) {
            newUri += tempUri.substring(index + 1);
        }
        
        return newUri;
    }

    return uri.path;
}

function wtMeta(name, content) {
    if (wtEnabled && name != null && content != null) {
        var metaDiv = document.getElementById('globalNav');
        if ( metaDiv != null ) {
            var formattedContent = content;
            var contentType = content.constructor;
            if ( contentType != null && contentType == Array ) {
                formattedContent = '';
                for ( var i = 0; i < content.length; i++ ) {
                    if ( content[i] != null && content[i] != '' ) {
                       formattedContent += (i > 0 && formattedContent.length > 0) ? ';' : '';
                       formattedContent += content[i];
                    }
                }
            }
        
            if ( formattedContent.length > 0 ) {
               var meta = document.createElement('META');
               meta.name = name;
               meta.content = formattedContent;
               metaDiv.appendChild(meta);
            }
        }
    }
}

function wtPrint() {
    if (wtEnabled) {
        var uri = parseUri(document.location);
        if ( document.title.indexOf('Search Results') != -1 ) {
            dcsMultiTrack('DSC.dcssip', uri.domain, 'DCS.dcsuri', uri.path, 'WT.ti', document.title, 'WT.tx_e', 'ptsr', 'DCSext.ptsrct', '1');
        } else if ( document.title.indexOf('Vehicle Details') != -1 ) {
            dcsMultiTrack('DSC.dcssip', uri.domain, 'DCS.dcsuri', uri.path, 'WT.ti', document.title, 'WT.tx_e', 'ptvd', 'DCSext.ptvdct', '1');
        }
    }
}

function wtOffsiteLink(url, title) {
    if (wtEnabled) {
        var uri = parseUri(url);
        dcsMultiTrack('DSC.dcssip', uri.domain, 'DCS.dcsuri', uri.path, 'DCS.dcsqry', uri.query, 'WT.ti', 'Offsite:' + title, 'WT.tx_e', 'tco', 'DCSext.tcoct', '1');
    }
}

function wtSRPSort(thisSort, currentDir, sortCount) {
    if (wtEnabled) {
        var ascending = true;
        if ( currentDir == '0' ) {
           ascending == true;
        } else if ( currentDir == '1' ) {
           ascending == false;
        }
    
        var uri = parseUri(document.location);
        dcsMultiTrack('DSC.dcssip', uri.domain, 'DCS.dcsuri', uri.path, 'WT.ti', document.title, 'DCSext.so', thisSort, 'DCSext.sord', (ascending ? 'Increasing' : 'Decreasing'), 'DCSext.sop', sortCount);
    }
}

function wtSRPAddRefine(field, value, refineCount) {
    if (wtEnabled) {
        var uri = parseUri(document.location);
        dcsMultiTrack('DSC.dcssip', uri.domain, 'DCS.dcsuri', uri.path, 'WT.ti', document.title, 'DCSext.prso', field, 'DCSext.rsdo', value, 'DCSext.rsoo', refineCount);
    }
}

function wtSRPDeleteRefine(field, value) {
    if (wtEnabled) {
        var uri = parseUri(document.location);
        dcsMultiTrack('DSC.dcssip', uri.domain, 'DCS.dcsuri', uri.path, 'WT.ti', document.title, 'DCSext.fr', value);
    }
}

function wtWorkbookAdd() {
    if (wtEnabled) {
        var uri = parseUri(document.location);
        dcsMultiTrack('DSC.dcssip', uri.domain, 'DCS.dcsuri', uri.path, 'WT.ti', document.title, 'WT.tx_e', 'awk', 'DCSext.awkct', '1');
    }
}

function wtSetUri() {
    var uri = parseUri(document.location);
    wtMeta('DCS.dcsuri', uri.path);
}


// Breadcrumbs
function wtSetFilters(names, values) {
    wtMeta('DCSext.pf', names);
    wtMeta('DCSext.pfv', values);
}


// Browse vs. Search
function wtSetSearch() {
    // Only if user clicked on 'Search' button
    wtMeta('DCSext.psopt', 'Search');
    wtMeta('WT.tx_e', 'sr');
    wtMeta('DCSext.sct', '1');
}
function wtSetBrowseMake(make) {
    wtMeta('DCSext.psopt', 'Browse');
    wtMeta('DCSext.bmake', make);
}
function wtSetBrowseAuction(auction) {
    wtMeta('DCSext.psopt', 'Browse');
    wtMeta('DCSext.baa', auction);
}
function wtSetBrowseState(state) {
    wtMeta('DCSext.psopt', 'Browse');
    wtMeta('DCSext.bstate', state);
}


// Search Form Elements
function wtSetFromYear(fromYear) {
    wtMeta('DCSext.fy', fromYear);
}
function wtSetToYear(toYear) {
    wtMeta('DCSext.ty', toYear);
}
function wtSetMake(make) {
    wtMeta('DCSext.make', make);
}
function wtSetModels(models) {
    wtMeta('DCSext.model', models);
}
function wtSetRegion(region) {
    wtMeta('DCSext.region', region);
}
function wtSetStates(states) {
    wtMeta('DCSext.state', states);
}
function wtSetCertification(certification) {
    wtMeta('DCSext.cert', certification);
}
function wtSetAuctions(auctions) {
    wtMeta('DCSext.actn', auctions);
}
function wtSetFromDistance(fromDistance) {
    wtMeta('DCSext.fromdis', fromDistance);
}
function wtSetToDistance(toDistance) {
    wtMeta('DCSext.todis', toDistance);
}
function wtSetMileage(mileage) {
    wtMeta('DCSext.miles', mileage);
}


// Error Handling
function wtSetError(errorCode, errorDesc) {
    wtMeta('DCSext.err', errorCode);
    wtMeta('DCSext.erd', errorDesc);
}
