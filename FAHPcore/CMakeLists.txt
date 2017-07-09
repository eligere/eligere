# Windows and Linux

CMAKE_MINIMUM_REQUIRED(VERSION 2.8)

PROJECT(fuzzyahp)

IF(WIN32)
	SET(CMAKE_SYSTEM_NAME Windows)
	SET(CMAKE_SYSTEM_VERSION 1)
	SET(CMAKE_CXX_FLAGS "${CMAKE_CXX_FLAGS} /Zc:wchar_t")
	SET(CMAKE_CXX_FLAGS_DEBUG "${CMAKE_CXX_FLAGS_DEBUG} /Zc:wchar_t")
ELSE()
	SET(CMAKE_SYSTEM_NAME Linux)
	SET(CMAKE_SYSTEM_VERSION 1)
	SET(CMAKE_CXX_FLAGS "${CMAKE_CXX_FLAGS}")
	SET(CMAKE_CXX_FLAGS_DEBUG "${CMAKE_CXX_FLAGS_DEBUG}")
	SET(CMAKE_CXX_FLAGS "-fPIC")
	SET(C_FLAG_MYSQL "-L/usr/lib/x86_64-linux-gnu -lmysqlclient -lpthread -lz -lm -ldl")
ENDIF()

SET(CMAKE_INCLUDE_CURRENT_DIR ON)

# Set the output folder where your program will be created
SET(CMAKE_BINARY_DIR ${CMAKE_SOURCE_DIR}/build/bin)
SET(EXECUTABLE_OUTPUT_PATH ${CMAKE_BINARY_DIR})
SET(LIBRARY_OUTPUT_PATH ${CMAKE_BINARY_DIR})

# Set QT
IF(WIN32)
	SET(QT_ROOT_DIR "C:/Qt/Qt5.7.0/5.7")
	SET(QT_QMAKE_EXECUTABLE ${QT_ROOT_DIR}/msvc2015_64/bin/qmake.exe)
	SET(QT_INCLUDE_DIR ${QT_ROOT_DIR}/msvc2015_64/include)
	SET(QT_LIB_DIR ${QT_ROOT_DIR}/msvc2015_64/lib)
ELSE()
	SET(QT_ROOT_DIR "/home/grazioso/Qt5.7.0/5.7")
	SET(QT_QMAKE_EXECUTABLE ${QT_ROOT_DIR}/gcc_64/bin/qmake)
	SET(QT_INCLUDE_DIR ${QT_ROOT_DIR}/gcc_64/include)
	SET(QT_LIB_DIR ${QT_ROOT_DIR}/gcc_64/lib)
	SET(SQL_INCLUDE_DIR "/usr/include/mysql")
	SET(SQL_LIB_DIR}_DIR "/usr/lib/mysql")
ENDIF()

SET(EIGEN3_INCLUDE_DIR ${CMAKE_SOURCE_DIR}/eigen/)

#Including libraries
#Here’s how you actually make use of a library. As the first step, you need to instruct the compiler to find a desired library and its components
IF(WIN32)
	SET(QT_LIBRARIES
		${QT_LIB_DIR}/Qt5Core.lib
		${QT_LIB_DIR}/Qt5Widgets.lib
		${QT_LIB_DIR}/Qt5Gui.lib
		${QT_LIB_DIR}/Qt5Sql.lib
		)
ELSE()
	SET(QT_LIBRARIES 
		${QT_LIB_DIR}/libQt5Core.so 
		${QT_LIB_DIR}/libQt5Widgets.so 
		${QT_LIB_DIR}/libQt5Gui.so 
		${QT_LIB_DIR}/libQt5Sql.so
)
ENDIF()

#Specifying header search paths
IF(WIN32)
		INCLUDE_DIRECTORIES("${PROJECT_SOURCE_DIR}")
		INCLUDE_DIRECTORIES (${EIGEN3_INCLUDE_DIR})
		INCLUDE_DIRECTORIES(${QT_INCLUDE_DIR})
		INCLUDE_DIRECTORIES(${QT_INCLUDE_DIR}/QtCore)
		INCLUDE_DIRECTORIES(${QT_INCLUDE_DIR}/QtWidgets)
		INCLUDE_DIRECTORIES(${QT_INCLUDE_DIR}/QtGui)
		INCLUDE_DIRECTORIES(${QT_INCLUDE_DIR}/QtSql)
ELSE()
		INCLUDE_DIRECTORIES("${PROJECT_SOURCE_DIR}")
		INCLUDE_DIRECTORIES (${EIGEN3_INCLUDE_DIR})
		INCLUDE_DIRECTORIES(${QT_INCLUDE_DIR})
		INCLUDE_DIRECTORIES(${QT_INCLUDE_DIR}/QtCore)
		INCLUDE_DIRECTORIES(${QT_INCLUDE_DIR}/QtWidgets)
		INCLUDE_DIRECTORIES(${QT_INCLUDE_DIR}/QtGui)
		INCLUDE_DIRECTORIES(${QT_INCLUDE_DIR}/QtSql)
		INCLUDE_DIRECTORIES(${SQL_INCLUDE_DIR})
ENDIF()


SET(QT5 ON CACHE BOOL "Use Qt5")
	
SET(Qt5Sql_DIR ${QT_LIB_DIR}/cmake/Qt5Sql)
SET(Qt5Widgets_DIR ${QT_LIB_DIR}/cmake/Qt5Widgets)
SET(Qt5Core_DIR ${QT_LIB_DIR}/cmake/Qt5Core)
SET(Qt5Gui_DIR ${QT_LIB_DIR}/cmake/Qt5Guiui)

MESSAGE("Using Qt5")
FIND_PACKAGE(Qt5Sql REQUIRED)
FIND_PACKAGE(Qt5Widgets REQUIRED)
FIND_PACKAGE(Qt5Gui REQUIRED)
FIND_PACKAGE(Qt5Core REQUIRED)

SET(UI mainwindow.ui)

QT5_WRAP_UI(HEADERS_UI ${UI})
QT5_WRAP_CPP(HEADERS_MOC ${QT_HEADERS})
QT5_ADD_RESOURCES(RESOURCES_RCC ${RESOURCES})

FILE(GLOB SRCS *.cpp)
FILE(GLOB HEADERS *.h)

IF(WIN32)
	LINK_DIRECTORIES(
					${EIGEN3_INCLUDE_DIR}
					${QT_LIB_DIR}
					${QT_LIBRARIES}
					)
ELSE()
	LINK_DIRECTORIES(
					${EIGEN3_INCLUDE_DIR}
					${QT_LIB_DIR}
					${QT_LIBRARIES}
					${SQL_LIB_DIR}
					)
ENDIF()

#Adding build targets
ADD_EXECUTABLE(fuzzyahp
    ${SRCS}
    ${HEADERS}
	${HEADERS_UI}
    ${HEADERS_MOC}
    ${RESOURCES_RCC}
)

#Next up, you need to link an executable to the located library:
#target_link_libraries (my_target ${my_library};${another_library})
#Note, that target_link_libraries() shall be placed after add_executable() command.

IF(WIN32)
	TARGET_LINK_LIBRARIES(fuzzyahp  
						 ${QT_LIBRARIES}
						 )
ELSE()
	TARGET_LINK_LIBRARIES(fuzzyahp
						 ${C_FLAG_MYSQL}
						 ${QT_LIBRARIES}
						 )
ENDIF()







